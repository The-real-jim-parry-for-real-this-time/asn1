<?php

/**
 * This is the model for the airplanes in the fleet, but with hard-coded data.
 *
 * @author Morris Arroyo
 */
class Fleet extends CI_Model
{

    var $data = array(
        '0' => array('manufacturer' => "Beechcraft", "model" => "Baron", "price" => "1350"
        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
        , "hourly" => "340"
        ),
        '1' => array('manufacturer' => "Beechcrraft", "model" => "Jayhawk", "price" => "1350"
        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
        , "hourly" => "340"
        ),
        '2' => array('manufacturer' => "Beechcrraft", "model" => "1900", "price" => "1350"
        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
        , "hourly" => "340"
        ),
        '3' => array('manufacturer' => "Beechcrraft", "model" => "Duke", "price" => "1350"
        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
        , "hourly" => "340"
        ),
        '4' => array('manufacturer' => "Airbus", "model" => "A320", "price" => "1350"
        , "seats" => "100", "reach" => "11948", "cruise" => "373", "takeoff" => "701"
        , "hourly" => "8340"
        ),
        '5' => array('manufacturer' => "Cessna", "model" => "400", "price" => "1350"
        , "seats" => "4", "reach" => "1948", "cruise" => "373", "takeoff" => "701"
        , "hourly" => "340"
        ),
        '6' => array('manufacturer' => "KnAAPO", "model" => "Su-37", "price" => "51,435,358"
        , "seats" => "1", "reach" => "59,000", "cruise" => "4,013", "takeoff" => "35,000"
        , "hourly" => "485,000"

        ),
//            'base' => array()
    );

    // Constructor
    public function __construct()
    {
        parent::__construct();

        foreach ($this->data as $key => $record)
        {
            $record['key'] = $key;
            $this->data[$key] = $record;
        }
    }

    // Retrieve a single airplane, null if not found
    public function get($which)
    {
        return !isset($this->data[$which]) ? null : $this->data[$which];
    }

    //Retrieve all of the airplanes
    public function all()
    {
        return $this->data;
    }

}