<?php

/**
 * This is model for airports, but with hard-code data.
 *
 * @author Morris Arroyo
 */
class Airports extends CSV_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct(APPPATH . '../data/airport.csv', 'id');
    }

    public function rules()
    {
        $config = array(
            ['field' => 'id', 'label' => 'Airports', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'code', 'label' => 'Code', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'type', 'label' => 'Type', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'name', 'label' => 'Name', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
        );
        return $config;
    }


    /**
     * @param string $code1 airport code 1
     * @param string $code2 airport code 2
     * @return int Kilometers between airports
     */
    public function kilometersBetweenAirports($code1, $code2) {

        $coord1 = null;
        $coord2 = null;

        foreach($this->all() AS $record) {

            //Airport::parseFromCoordinates($coordinateString)

            if($code1 == $record->code) $coord1 = Airport::parseFromCoordinates($record->coordinates);
            if($code2 == $record->code) $coord2 = Airport::parseFromCoordinates($record->coordinates);

        }


        if(empty($coord1) || empty($coord2)) {
            return 0;
        }


        return round(GPS::getDistanceBetween($coord1[0], $coord1[1], $coord2[0], $coord2[1]) / 1000);

    }

}