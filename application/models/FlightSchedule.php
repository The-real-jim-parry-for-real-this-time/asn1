<?php

/**
 * This is model for flights, but with hard-code data.
 *
 * @author Brayden Traas
 */
require_once 'Airplanes.php';
require_once 'Airports.php';

class FlightSchedule extends CSV_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct(APPPATH . '../data/flights.csv', 'id');

        foreach ($this->all() as $key => $record)
        {
            $this->get($key)->airplanes = [(new Airplanes)->get($record->airplanes)];
            $this->get($key)->depart_airport = [(new Airports)->get($record->depart_airport)];
            $this->get($key)->arrive_airport = [(new Airports)->get($record->arrive_airport)];
        }
    }

    public function rules()
    {
        $config = array(
            ['field' => 'airplanes', 'label' => 'airplane', 'rules' => 'integer'],
            ['field' => 'depart_airport', 'label' => 'depart airport', 'rules' => 'integer'],
            ['field' => 'depart_time', 'label' => 'depart time', 'rules' => 'required'],
            ['field' => 'arrive_airport', 'label' => 'arrive airport', 'rules' => 'integer'],
            ['field' => 'arrive_time', 'label' => 'arrive time', 'rules' => 'required']
        );
        return $config;
    }


    /*
     * There are some restrictions on your schedule:
	• no departures before 08:00
	• no landings after 22:00
	• minimum 30 minutes between a plane's landing and any subsequent departure
	• all of your fleet must be back at your airline base by the end of the day
	• flight times need to be reasonable, based on distance between airports, airplane cruising speed,
            and a 10 minute buffer added to each flight in order to reach cruising/landing speed and altitude
     */


    /**
     *
     * Checks if a plane is available at this time.
     *
     * Does NOT check if this plane is actually at an airport
     *
     * @param $plane integer plane id
     * @param $departureTimestamp int timestamp
     * @param $arrivalTimestamp int timestamp
     * @return bool on valid
     */
    public function validatePlaneAvailable($plane, $departureTimestamp, $arrivalTimestamp) {

        // ensure departure < arrival

        if($departureTimestamp != intval($departureTimestamp)) return false;
        if($arrivalTimestamp != intval($arrivalTimestamp)) return false;

        if($departureTimestamp >= $arrivalTimestamp) return false;



        // check if this plane is in our DB

        $planes = (new Airplanes)->all();
        $found = false;
        foreach($planes AS $planeRecord) {
            if($plane == $planeRecord['id']) {
                $found = true;
                break;
            }

        }
        if(!$found) return false; // plane is not in our db

        // now get all other flights this plane has

        $allFlights = $this->all();

        foreach($allFlights AS $flight) {

            //var_dump($flight);

            // Declaration in FlightSchedule()
            //$flight->airplanes = [(new Airplanes)->get($record->airplanes)]

            // so ->airplanes is an array of Airplanes records

            foreach($flight->airplanes AS $id => $flightPlane) { // can there really be more than one?

                // disregard planes that aren't our plane to validate
                if($id != $plane) continue;


//                $this->get($key)->depart_airport = [(new Airports)->get($record->depart_airport)];
//                $this->get($key)->arrive_airport = [(new Airports)->get($record->arrive_airport)];

                //$flight->depart_ai


                $planeDepartTimestamp = strtotime($flight->depart_time);
                $planeArriveTimestamp = strtotime($flight->arrive_time);


                // make a plane busy 30 minutes before and after a flight
                $planeBusyStart = strtotime("-30 minutes", $planeDepartTimestamp);
                $planeBusyEnd   = strtotime("+30 minutes", $planeArriveTimestamp);


                // now check if the times overlap at all

                // checked flight ends before this flight is busy. Carry on
                if( $arrivalTimestamp <= $planeBusyStart )  continue;
                if( $departureTimestamp >= $planeBusyEnd ) continue;

                if( $departureTimestamp <= $planeBusyStart && $arrivalTimestamp >= $planeBusyStart ) return false;
                if( $departureTimestamp <= $planeBusyEnd   && $arrivalTimestamp >= $planeBusyEnd   ) return false;



//                // not sure why there can be multiple. Connecting flights maybe?
//                foreach($flight->depart_airport AS $departAirport) {
//
//                }

            }
        }

        return true;
    }


}