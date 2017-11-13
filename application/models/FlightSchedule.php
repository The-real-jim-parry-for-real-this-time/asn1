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
        }
    }

    public function rules()
    {
        $config = array(
            ['field' => 'airplanes', 'label' => 'airplane', 'rules' => 'integer'],
            ['field' => 'depart_airport', 'label' => 'depart airport', 'rules' => 'integer'],
            ['field' => 'depart_time', 'label' => 'depart time', 'rules' => 'integer'],
            ['field' => 'arrive_airport', 'label' => 'arrive airport', 'rules' => 'integer'],
            ['field' => 'arrive_time', 'label' => 'arrive time', 'rules' => 'integer']
        );
        return $config;
    }
}