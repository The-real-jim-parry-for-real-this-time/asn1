<?php

/**
 * This is model for airports, but with hard-code data.
 *
 * @author Morris Arroyo
 */
class Airport extends CSV_Model
{
    // Constructor
    public function __construct()
    {
        parent::__construct(APPPATH . '../data/airport.csv', 'id');
    }

    public function rules()
    {
        $config = array(
            ['field' => 'id', 'label' => 'airport', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'code', 'label' => 'Code', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'type', 'label' => 'Type', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'name', 'label' => 'Name', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
        );
        return $config;
    }
}