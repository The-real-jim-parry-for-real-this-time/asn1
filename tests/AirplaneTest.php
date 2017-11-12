<?php
if (! class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

/**
 * This test covers the airplane model.
 * Airplane.php.
 *
 * @property Airplane $airplane
 *
 * @author Morris Arroyo
 */
class AirplaneTest extends PHPUnit_Framework_TestCase
{
    private $airplane;
    private $CI;

    private $airplanes_json;
    private $valid_airplanes;
    private $valid_models;
    private $first_char;

    /*
     * Test setup.
     */
    public function setUp()
    {
        // Load CI instance normally
        $this->CI = &get_instance();
        $this->airplanes_json = '[ { "id": "avanti", "manufacturer": "Piaggo", "model": "Avanti II", "price": "7195", "seats": "8", "reach": "2797", "cruise": "589", "takeoff": "994", "hourly": "977" }, { "id": "baron", "manufacturer": "Beechcraft", "model": "Baron", "price": "1350", "seats": "4", "reach": "1948", "cruise": "373", "takeoff": "701", "hourly": "340" }, { "id": "caravan", "manufacturer": "Cessna", "model": "Grand Caravan EX", "price": "2300", "seats": "14", "reach": "1689", "cruise": "340", "takeoff": "660", "hourly": "389" }, { "id": "citation", "manufacturer": "Cessna", "model": "Citation M2", "price": "3200", "seats": "7", "reach": "1550", "cruise": "748", "takeoff": "978", "hourly": "1122" }, { "id": "kingair", "manufacturer": "Beechcraft", "model": "King Air C90", "price": "3900", "seats": "12", "reach": "2446", "cruise": "500", "takeoff": "1402", "hourly": "990" }, { "id": "mustang", "manufacturer": "Cessna", "model": "Citation Mustang", "price": "2770", "seats": "4", "reach": "2130", "cruise": "630", "takeoff": "950", "hourly": "1015" }, { "id": "pc12ng", "manufacturer": "Pilatus", "model": "PC-12 NG", "price": "3300", "seats": "9", "reach": "4147", "cruise": "500", "takeoff": "450", "hourly": "727" }, { "id": "phenom100", "manufacturer": "Embraer", "model": "Phenom 100", "price": "2980", "seats": "4", "reach": "2148", "cruise": "704", "takeoff": "1036", "hourly": "926" } ]';
        $this->valid_airplanes = json_decode($this->airplanes_json);
        $this->airplane = new Airplane();
        $this->valid_models = [];
        $this->first_char = "t";
        foreach ($this->valid_airplanes as $plane) {
            $this->valid_models.array_push($plane->model);
        }
    }

    // TEST FOR AIRPLANE

    /*Valid tests on Airplane*/
    public function testIdMaxValid() {
        $value = "";
        for($i = 0; $i < 64; $i++) {
            $value .= $this->first_char;
        }
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->id, $value);
    }

    public function testIdCharsValid() {
        $value = $this->first_char . "abcde12345";
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->id, $value);
    }

    public function testIdFirstCharValid() {
        $value = $this->first_char . "00000";
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->id, $value);
    }

    public function testManufacturerMaxValid() {
        $value = "";
        for($i = 0; $i < 64; $i++) {
            $value .= $this->first_char;
        }
        $this->airplane->manufacturer = $value;
        $this->assertEquals($this->airplane->manufacturer, $value);
    }

    /*Invalid tests on Airplane*/
    public function testIdMaxInvalid() {
        $value = "";
        for($i = 0; $i < 65; $i++)  {
            $value .= $this->first_char;
        }
        $this->airplane->id = $value;
        $this->assertNotEquals($this->airplane->id, $value);
    }

    public function testIdCharsInvalid() {
        $value = $this->first_char . "abcde#!@#$#";
        $this->airplane->id = $value;
        $this->assertNotEquals($this->airplane->id, $value);
    }

    public function testIdFirstCharInvalid() {
        $value = "x00000";
        $this->airplane->id = $value;
        $this->assertNotEquals($this->airplane->id, $value);
    }
}