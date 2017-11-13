<?php

/**
 * This is the model for a flight
 *
 * @author Brayden Traas
 */
class Flight extends Entity
{

    private static $identifier = "S";


    protected $id;
    protected $code;
    protected $airplane;
    protected $departAirport;
    protected $departTime;
    protected $arriveAirport;
    protected $arriveTime;

    /*
     * ['field' => 'id', 'label' => 'Plane', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'code', 'label' => 'Manufacturer', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'airplanes', 'label' => 'Model', 'rules' => 'integer'],
            ['field' => 'depart_airport', 'label' => 'Price', 'rules' => 'integer'],
            ['field' => 'depart_time', 'label' => 'Seats', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'arrive_airport', 'label' => 'Reach', 'rules' => 'integer'],
            ['field' => 'arrive_time', 'label' => 'Cruise', 'rules' => 'alpha_numeric_spaces|max_length[64]']
     */


    /*
     * There are some restrictions on your schedule:
	• no departures before 08:00
	• no landings after 22:00
	• minimum 30 minutes between a plane's landing and any subsequent departure
	• all of your fleet must be back at your airline base by the end of the day
	• flight times need to be reasonable, based on distance between airports, airplane cruising speed,
            and a 10 minute buffer added to each flight in order to reach cruising/landing speed and altitude
     */

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $departure integer timestamp
     * @param $arrival integer timestamp
     * @param $departAirport integer id
     * @param $arriveAirport integer id
     * @param $plane integer id
     * @return bool on valid
     */
    protected static function validateFlightTimes($departure, $arrival, $departAirport, $arriveAirport, $plane) {

        $dummy_distance = 1000;

        $plane = (new AirPlanes)->get($plane);

        // time = distance / speed

        $cruiseKmPh = $plane->cruise;

        $cruiseKmPm = ($cruiseKmPh / 60);

        $expectedMinutes = ($dummy_distance / $cruiseKmPm) + 10;

        $scheduledMinutes = round(abs($arrival - $departure) / 60,2);

        if($scheduledMinutes < $expectedMinutes) return false;

        else return true;


    }


    /**
     * @param $value Integer
     */
    public function setId($value) {


        // check valid character type
        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($alNum[0] != self::$identifier) return;



        if($value != intval($value)) return;

        $this->id = $value;
    }

    /**
     * @param $value String (Airport code eg. YVR)
     */
    public function setCode($value){

        // check valid character type
        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if($alNum[0] != self::$identifier) return;


        if(strlen($value) > 64) {
            return;
        }

        $this -> code = $value;
    }

    /**
     * @param $value integer Airplane ID
     */
    public function setAirplane($value){
        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;


        if(isset($this->departTime) && isset($this->arriveTime)) {
            $valid = (new FlightSchedule)->validatePlaneAvailable($value, $this->departTime, $this->arriveTime);
            if(!$valid) return;
        }


        $this -> airplane = $value;
    }

    /**
     * @param $value string Airport code
     */
    public function setDepartAirport($value){

        $alNum = preg_replace('/[^0-9A-Z]/', '', $value);
        if($value != $alNum) return;

        //if($value != intval($value)) return;

        if(strlen($alNum) != 3) return;

        $this -> departAirport = $value;
    }

    /**
     * @param $value Integer Depart timestamp
     */
    public function setDepartTime($value){

        // check valid character type
//        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
//        if($value != $alNum) return;
//
//        if(strlen($value) > 64) {
//            return;
//        }

        $num = preg_replace('/[^0-9]/i', '', $value);
        if($num != $value) return;

        if($value != intval($value)) return;

        if(date("G",$value) < 8) return; // no departures before 8am


        if(isset($this->arriveTime) && isset($this->airplane)) {
            $valid = (new FlightSchedule)->validatePlaneAvailable($this->airplane, $value, $this->arriveTime);
            if(!$valid) return;
        }

        if(isset($this->arriveTime)) {
            if($this->arriveTime <= $value) return;
        }


        $this -> departTime = $value;
    }

    /**
     * @param $value string airport code
     */
    public function setArriveAirport($value){

        $alNum = preg_replace('/[^0-9A-Z]/', '', $value);
        if($value != $alNum) return;

        //if($value != intval($value)) return;

        if(strlen($alNum) != 3) return;

        $this -> arriveAirport = $value;
    }

    /**
     * @param $value Integer arrive timestamp
     */
    public function setArriveTime($value){

        $num = preg_replace('/[^0-9]/i', '', $value);
        if($num != $value) return;

        if($value != intval($value)) return;

        if(date("G",$value) > 21) return; // no departures after 22:00

        if(isset($this->departTime) && isset($this->airplane)) {
            $valid = (new FlightSchedule)->validatePlaneAvailable($this->airplane, $this->departTime, $value);
            if(!$valid) return;

        }

        if(isset($this->departTime)) {
            if($this->departTime >= $value) return;
        }


        $this -> arriveTime = $value;
    }

    /**
     * @return bool
     */
    public function isValid() {
        $valid = (new FlightSchedule)->validatePlaneAvailable($this->airplane, $this->departTime, $this->arriveTime);
        if(!$valid) return false;


        $valid = self::validateFlightTimes($this->departtime, $this->arriveTime, $this->departAirport, $this->arriveAirport, $this->airplane);
        return $valid;

    }

}