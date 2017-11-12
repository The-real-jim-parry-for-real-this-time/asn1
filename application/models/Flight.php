<?php

/**
 * This is the model for a flight
 *
 * @author Brayden Traas
 */
class Flight extends Entity
{
    protected $id;
    protected $code;
    protected $airplanes;
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

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }


    public function setId($value) {


        // check valid character type
        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if(strlen($value) > 64) {
            return;
        }

        $this->id = $value;
    }

    public function setCode($value){

        // check valid character type
        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if(strlen($value) > 64) {
            return;
        }

        $this -> code = $value;
    }

    public function setAirplanes($value){
        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> airplanes = $value;
    }

    public function setDepartAirport($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> departAirport = $value;
    }

    public function setDepartTime($value){

        // check valid character type
        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if(strlen($value) > 64) {
            return;
        }

        $this -> departTime = $value;
    }

    public function setArriveAirport($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> arriveAirport = $value;
    }

    public function setArriveTime($value){

        // check valid character type
        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if(strlen($value) > 64) {
            return;
        }

        $this -> arriveTime = $value;
    }

}