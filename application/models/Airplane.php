<?php
require_once APPPATH . 'core/Entity.php';
/**
 * This is the model for an airplane
 *
 * @author Brayden Traas
 */
class Airplane extends Entity
{
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