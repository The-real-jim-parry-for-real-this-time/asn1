<?php

/**
 * This is model for flights, but with hard-code data.
 *
 * @author Brayden Traas
 */
require_once 'Airplanes.php';
require_once 'Airport.php';

class FlightSchedule extends CSV_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct(APPPATH . '../data/flights.csv', 'id');

        foreach ($this->all() as $key => $record)
        {
            $this->get($key)->airplanes = [(new Airplanes)->get($record->airplanes)];
            $this->get($key)->depart_airport = [(new Airport)->get($record->depart_airport)];
            $this->get($key)->arrive_airport = [(new Airport)->get($record->arrive_airport)];
            //$this->data[$key]['airplanes'] = [(new Airplanes)->get($record['airplanes'])];
            //$this->data[$key]['depart_airport'] = [(new Airport)->get($record['depart_airport'])];
            //$this->data[$key]['arrive_airport'] = [(new Airport)->get($record['arrive_airport'])];   
        }

    }

    public function rules()
    {
        $config = array(
            ['field' => 'id', 'label' => 'Plane', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'code', 'label' => 'Manufacturer', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'airplanes', 'label' => 'Model', 'rules' => 'integer'],
            ['field' => 'depart_airport', 'label' => 'Price', 'rules' => 'integer'],
            ['field' => 'depart_time', 'label' => 'Seats', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'arrive_airport', 'label' => 'Reach', 'rules' => 'integer'],
            ['field' => 'arrive_time', 'label' => 'Cruise', 'rules' => 'alpha_numeric_spaces|max_length[64]']
        );
        return $config;
    }
}