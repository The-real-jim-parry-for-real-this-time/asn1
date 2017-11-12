<?php
require_once APPPATH . 'core/Entity.php';
/**
 * This is the model for an airplane
 *
 * @author Brayden Traas
 */
class Airplane extends Entity
{
    protected $id;
    protected $manufacturer;
    protected $model;
    protected $price;
    protected $seats;
    protected $reach;
    protected $cruise;
    protected $takeoff;
    protected $hourly;
//
//['field' => 'id', 'label' => 'Plane', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
//['field' => 'manufacturer', 'label' => 'Manufacturer', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
//['field' => 'model', 'label' => 'Model', 'rules' => 'integer'],
//['field' => 'price', 'label' => 'Price', 'rules' => 'integer'],
//['field' => 'seats', 'label' => 'Seats', 'rules' => 'integer'],
//['field' => 'reach', 'label' => 'Reach', 'rules' => 'integer'],
//['field' => 'cruise', 'label' => 'Cruise', 'rules' => 'integer'],
//['field' => 'takeoff', 'label' => 'Takeoff', 'rules' => 'integer'],
//['field' => 'hourly', 'label' => 'Hourly', 'rules' => 'integer'],

    /*Valid tests on Airplane*/
    public function testIdMaxValid() {
        $value = "";
        for($i = 0; $i < 64; $i++) {
            $value .= $this->first_char;
        }
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->getId(), $value);
    }

    public function testIdCharsValid() {
        $value = $this->first_char . "abcde12345";
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->getId(), $value);
    }

    public function testIdFirstCharValid() {
        $value = $this->first_char . "00000";
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->getId(), $value);
    }

    public function testManufacturerMaxValid() {
        $value = "";
        for($i = 0; $i < 64; $i++) {
            $value .= $this->first_char;
        }
        $this->airplane->manufacturer = $value;
        $this->assertEquals($this->airplane->getManufacturer(), $value);
    }

    /*Invalid tests on Airplane*/
    public function testIdMaxInvalid() {
        $value = "";
        for($i = 0; $i < 65; $i++)  {
            $value .= $this->first_char;
        }
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->getId(), $value);
    }

    public function testIdCharsInvalid() {
        $value = $this->first_char . "abcde#!@#$#";
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->getId(), $value);
    }

    public function testIdFirstCharInvalid() {
        $value = "x00000";
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->getId(), $value);
    }

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

        $this -> id = $value;
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