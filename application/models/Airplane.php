<?php

/**
 * This is the model for an airplane
 *
 * @author Brayden Traas
 */
class Airplane extends Entity
{

//    var $data = array(
//        '0' => array('manufacturer' => "Beechcraft", "model" => "Baron", "price" => "1350"
//        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
//        , "hourly" => "340"
//        ),
//        '1' => array('manufacturer' => "Beechcrraft", "model" => "Jayhawk", "price" => "1350"
//        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
//        , "hourly" => "340"
//        ),
//        '2' => array('manufacturer' => "Beechcrraft", "model" => "1900", "price" => "1350"
//        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
//        , "hourly" => "340"
//        ),
//        '3' => array('manufacturer' => "Beechcrraft", "model" => "Duke", "price" => "1350"
//        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
//        , "hourly" => "340"
//        ),
//        '4' => array('manufacturer' => "Airbus", "model" => "A320", "price" => "1350"
//        , "seats" => "100", "reach" => "11948", "cruise" => "373", "takeoff" => "701"
//        , "hourly" => "8340"
//        ),
//        '5' => array('manufacturer' => "Cessna", "model" => "400", "price" => "1350"
//        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
//        , "hourly" => "340"
//        ),
//        '6' => array('manufacturer' => "KnAAPO", "model" => "Su-37", "price" => "51,435,358"
//        , "seats" => "1", "reach" => "59,000", "cruise" => "4,013", "takeoff" => "35,000"
//        , "hourly" => "485,000"
//
//        ),
////            'base' => array()
//    );


    protected $manufacturer;
    protected $model;
    protected $price;
    protected $seats;
    protected $reach;
    protected $cruise;
    protected $takeoff;
    protected $hourly;

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    public function setManufacturer($value){
        $this -> manufacturer = $value;
    }

    public function setModel($value){
        $this -> model = $value;
    }

    public function setPrice($value){
        $this -> price = $value;
    }

    public function setSeats($value){

        $this -> seats = $value;
    }

    public function setReach($value){

        $this -> reach = $value;
    }

    public function setCruise($value){

        $this -> cruise = $value;
    }

    public function setTakeoff($value){

        $this -> takeoff = $value;
    }

    public function setHourly($value){

        $this -> hourly = $value;
    }


}