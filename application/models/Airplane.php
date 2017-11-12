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

        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if(strlen($value) > 64) {
            return;
        }

        $this -> manufacturer = $value;
    }

    public function setModel($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> model = $value;
    }


    public function setPrice($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> price = $value;
    }


    public function setSeats($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;


        $this -> seats = $value;
    }


    public function setReach($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;


        $this -> reach = $value;
    }


    public function setCruise($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> cruise = $value;
    }


    public function setTakeoff($value){


        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> takeoff = $value;
    }


    public function setHourly($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;


        $this -> hourly = $value;
    }


}