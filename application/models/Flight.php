<?php

/**
 * This is the model for a flight
 *
 * @author Brayden Traas
 */
class Flight extends Entity
{
    protected $code;
    protected $airplanes;
    protected $departAirport;
    protected $departTime;
    protected $arriveAirport;
    protected $arriveTime;


    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    public function setCode($value){
        $this -> code = $value;
    }

    public function setAirplanes($value){
        $this -> airplanes = $value;
    }

    public function setDepartAirport($value){
        $this -> departAirport = $value;
    }

    public function setDepartTime($value){

        $this -> departTime = $value;
    }

    public function setArriveAirport($value){

        $this -> arriveAirport = $value;
    }

    public function setArriveTime($value){

        $this -> arriveTime = $value;
    }

}