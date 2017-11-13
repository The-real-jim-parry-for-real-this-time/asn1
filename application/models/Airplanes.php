<?php

/**
 * This is the model for the airplanes in the fleet, but with hard-coded data.
 *
 * @author Morris Arroyo
 */
class Airplanes extends CSV_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct(APPPATH . '../data/fleet.csv', 'id');
    }

    public function rules()
    {
        $config = array(
            ['field' => 'manufacturer', 'label' => 'Manufacturer', 'rules' => 'required|alpha_numeric_spaces|max_length[64]'],
            ['field' => 'model', 'label' => 'Model', 'rules' => 'required|max_length[64]'],
            ['field' => 'price', 'label' => 'Price', 'rules' => 'integer'],
            ['field' => 'seats', 'label' => 'Seats', 'rules' => 'integer'],
            ['field' => 'reach', 'label' => 'Reach', 'rules' => 'integer'],
            ['field' => 'cruise', 'label' => 'Cruise', 'rules' => 'integer'],
            ['field' => 'takeoff', 'label' => 'Takeoff', 'rules' => 'integer'],
            ['field' => 'hourly', 'label' => 'Hourly', 'rules' => 'integer'],
        );
        return $config;
    }

}