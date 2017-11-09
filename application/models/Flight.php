<?php

/**
 * This is the model for a flight
 *
 * @author Brayden Traas
 */
class Flight extends Entity
{
//
//    var $data = [
//        0 => array('code' => IDENTIFIER_CHAR . "001", 'Fleet' => 0, 'depart_airport' => 0, 'depart_time' => '12:25', 'arrive_airport' => 1, 'arrive_time' => '23:15' )
//        ,1 => array('code' => IDENTIFIER_CHAR . "002", 'Fleet' => 1, 'depart_airport' => 3, 'depart_time' => '04:04', 'arrive_airport' => 2, 'arrive_time' => '08:55' )
//        ,2 => array('code' => IDENTIFIER_CHAR . "003", 'Fleet' => 2, 'depart_airport' => 2, 'depart_time' => '09:56', 'arrive_airport' => 0, 'arrive_time' => '14:11' )
//        ,3 => array('code' => IDENTIFIER_CHAR . "004", 'Fleet' => 3, 'depart_airport' => 0, 'depart_time' => '01:15', 'arrive_airport' => 3, 'arrive_time' => '06:41' )
//        ,4 => array('code' => IDENTIFIER_CHAR . "005", 'Fleet' => 4, 'depart_airport' => 1, 'depart_time' => '04:34', 'arrive_airport' => 3, 'arrive_time' => '07:45' )
//        ,5 => array('code' => IDENTIFIER_CHAR . "006", 'Fleet' => 5, 'depart_airport' => 0, 'depart_time' => '07:26', 'arrive_airport' => 2, 'arrive_time' => '13:19' )
//        ,6 => array('code' => IDENTIFIER_CHAR . "007", 'Fleet' => 6, 'depart_airport' => 1, 'depart_time' => '03:45', 'arrive_airport' => 3, 'arrive_time' => '04:31' )
////            'base' => array()
//    ];


    protected $code;
    protected $fleet;
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

    public function setFleet($value){
        $this -> fleet = $value;
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