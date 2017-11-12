<?php
if (! class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}
if (! class_exists('PHPUnit_Framework_ExpectationFailedException')) {
    class_alias('PHPUnit\Framework\ExpectationFailedException', 'PHPUnit_Framework_ExpectationFailedException');
}
/**
 * This test covers the airplanes collection class
 * Airplanes.php.
 *
 * @property Airplanes $airplanes
 *
 * @author Morris Arroyo
 */
class AirplanesListTest extends PHPUnit_Framework_TestCase
{

    //JSON of airplanes from the vault
    private $airplanes_json;

    //Array of airplanes from the vault
    private $decoded_airplanes;

    //List of valid airplanes with key as their model
    private $valid_airplanes;

    //List of airplanes
    private $airplanes;

    /*
     * Test setup.
     */
    public function setUp()
    {
        $this->airplanes_json = '[ { "id": "avanti", "manufacturer": "Piaggo", "model": "Avanti II", "price": "7195", "seats": "8", "reach": "2797", "cruise": "589", "takeoff": "994", "hourly": "977" }, { "id": "baron", "manufacturer": "Beechcraft", "model": "Baron", "price": "1350", "seats": "4", "reach": "1948", "cruise": "373", "takeoff": "701", "hourly": "340" }, { "id": "caravan", "manufacturer": "Cessna", "model": "Grand Caravan EX", "price": "2300", "seats": "14", "reach": "1689", "cruise": "340", "takeoff": "660", "hourly": "389" }, { "id": "citation", "manufacturer": "Cessna", "model": "Citation M2", "price": "3200", "seats": "7", "reach": "1550", "cruise": "748", "takeoff": "978", "hourly": "1122" }, { "id": "kingair", "manufacturer": "Beechcraft", "model": "King Air C90", "price": "3900", "seats": "12", "reach": "2446", "cruise": "500", "takeoff": "1402", "hourly": "990" }, { "id": "mustang", "manufacturer": "Cessna", "model": "Citation Mustang", "price": "2770", "seats": "4", "reach": "2130", "cruise": "630", "takeoff": "950", "hourly": "1015" }, { "id": "pc12ng", "manufacturer": "Pilatus", "model": "PC-12 NG", "price": "3300", "seats": "9", "reach": "4147", "cruise": "500", "takeoff": "450", "hourly": "727" }, { "id": "phenom100", "manufacturer": "Embraer", "model": "Phenom 100", "price": "2980", "seats": "4", "reach": "2148", "cruise": "704", "takeoff": "1036", "hourly": "926" } ]';
        $this->decoded_airplanes = json_decode($this->airplanes_json);
        $this->valid_airplanes = [];
        foreach ($this->decoded_airplanes as $plane) {
            $this->valid_airplanes[$plane->model] = $plane;
        }
        $this->airplanes = new Airplanes();
    }

    public function testAirplanesModelsListValid() {
        $failures = [];
        foreach($this->airplanes->all() as $airplane) {

            try {
                $this->assertArrayHasKey($airplane->model, $this->valid_airplanes
                    , "array is list of valid plane models");
            } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                $failures[] = $e->getMessage();
            }
        }
        if(!empty($failures)) {
            throw new PHPUnit_Framework_ExpectationFailedException (
                count($failures) . " assertions failed:\n\t" . implode("\n\t", $failures)
            );
        }
    }

    public function testAirplanesListValid() {
        $failures = [];
        foreach($this->airplanes->all() as $airplane) {
           if(array_key_exists($airplane->model, $this->valid_airplanes)) {
               try {
                   $this->assertEquals($airplane->manufacturer  , $this->valid_airplanes[$airplane->model]->manufacturer);
               } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                   $failures[] = $e->getMessage();
               }
               try {
               $this->assertEquals($airplane->price         , $this->valid_airplanes[$airplane->model]->price);
               } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                   $failures[] = $e->getMessage();
               }
               try {
               $this->assertEquals($airplane->seats         , $this->valid_airplanes[$airplane->model]->seats);
               } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                   $failures[] = $e->getMessage();
               }
               try {
               $this->assertEquals($airplane->reach         , $this->valid_airplanes[$airplane->model]->reach);
               } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                   $failures[] = $e->getMessage();
               }
               try {
               $this->assertEquals($airplane->cruise        , $this->valid_airplanes[$airplane->model]->cruise);
               } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                   $failures[] = $e->getMessage();
               }
               try {
               $this->assertEquals($airplane->takeoff       , $this->valid_airplanes[$airplane->model]->takeoff);
               } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                   $failures[] = $e->getMessage();
               }
               try {
               $this->assertEquals($airplane->hourly        , $this->valid_airplanes[$airplane->model]->hourly);
               } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                   $failures[] = $e->getMessage();
               }
           } else {
               try {
               $this->assertArrayHasKey($airplane->model, $this->valid_airplanes
                   , "array is list of valid plane models");
               } catch (PHPUnit_Framework_ExpectationFailedException $e) {
                   $failures[] = $e->getMessage();
               }
           }
        }
        if(!empty($failures)) {
            throw new PHPUnit_Framework_ExpectationFailedException (
                count($failures) . " assertions failed:\n\t" . implode("\n\t", $failures)
            );
        }
    }
}