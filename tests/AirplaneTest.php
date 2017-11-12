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
    private $CI;

    private $airplane;

    //JSON of airplanes from the vault
    private $airplanes_json;

    //Array of airplanes from the vault
    private $valid_airplanes;

    //List of valid models
    private $valid_models;

    //Valid first character for identifiers (S for Swallow)
    private $first_char;

    //Smallest allowable integer
    private $min_valid_int;

    //Number of character in the longest allowable string length
    private $max_valid_strlen;

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
        $this->first_char = "S";
        $this->min_valid_int = 0;
        $this->max_valid_strlen = 64;
        foreach ($this->valid_airplanes as $plane) {
            $this->valid_models[] = $plane->model;
        }
    }

    //TESTS FOR ID

    //Valid tests for id

    //String length equal to max allowable
    public function testIdMaxValid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen; $i++) {
            $value .= $this->first_char;
        }
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->id, $value);
    }

    //String characters limited to alphanumeric characters
    public function testIdCharsValid()
    {
        $value = $this->first_char . "abcde12345";
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->id, $value);
    }

    //First character equal to first character of group name
    public function testIdFirstCharValid()
    {
        $value = $this->first_char . "00000";
        $this->airplane->id = $value;
        $this->assertEquals($this->airplane->id, $value);
    }

//    public function testManufacturerMaxValid() {
//        $value = "";
//        for($i = 0; $i < 64; $i++) {
//            $value .= $this->first_char;
//        }
//        $this->airplane->manufacturer = $value;
//        $this->assertEquals($this->airplane->manufacturer, $value);
//    }
    //Invalid tests for id

    //String longer than max allowable
    public function testIdMaxInvalid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen + 1; $i++) {
            $value .= $this->first_char;
        }
        $this->airplane->id = $value;
        $this->assertNotEquals($this->airplane->id, $value);
    }

    //String characters including symbols and punctuations
    public function testIdCharsInvalid()
    {
        $value = $this->first_char . "abcde!@#$%^&*()_+{}:\" <>?~`-=[];\',./\\";
        $this->airplane->id = $value;
        $this->assertNotEquals($this->airplane->id, $value);
    }

    //First character is random alphanumeric character
    public function testIdFirstCharInvalid()
    {
        $value = "x00000";
        $this->airplane->id = $value;
        $this->assertNotEquals($this->airplane->id, $value);

    }

    // TESTS FOR MANUFACTURER

    // Valid tests for manufacturer

    // String equal to max allowable
    public function testManufacturerMaxValid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen; $i++) {
            $value .= "m";
        }
        $this->airplane->manufacturer = $value;
        $this->assertEquals($this->airplane->manufacturer, $value);
    }

    // Invalid tests for manufacturer

    // Longer string than max allowable.
    public function testManufacturerMaxInvalid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen + 1; $i++) {
            $value .= "m";
        }
        $this->airplane->manufacturer = $value;
        $this->assertNotEquals($this->airplane->manufacturer, $value);
    }

    //TESTS FOR MODEL

    //Valid tests for model

    //Model number is smallest allowable.
    public function testModelMinValid()
    {
        $value = $this->min_valid_int;
        $this->aiplane->model = $value;
        $this->assertEquals($this->airplane->model, $value);
    }

    //Invalid tests for model

    //Model number is smaller than smallest allowable.
    public function testModelMinInvalid()
    {
        $value = $this->min_valid_int - 1;
        $this->airplane->model = $value;
        $this->assertNotEquals($this->aiplane->model, $value);
    }

    //TESTS FOR PRICE

    //Valid tests for price

    //Price number is the smallest allowable.
    public function testPriceMinValid()
    {
        $value = $this->min_valid_int;
        $this->aiplane->price = $value;
        $this->assertEquals($this->airplane->price, $value);
    }

    //Invalid tests for price

    //Price number is smaller than smallest allowable
    public function testPriceMinInvalid()
    {
        $value = $this->min_valid_int - 1;
        $this->airplane->price = $value;
        $this->assertNotEquals($this->airplane->price, $value);
    }

    //TESTS FOR SEATS

    //Valid tests for seats

    //Seats number is the smallest allowable.
    public function testSeatsMinValid()
    {
        $value = $this->min_valid_int;
        $this->airplane->seats = $value;
        $this->assertEquals($this->airplane->seats, $value);
    }

    //Invalid tests for seats

    //Seats number is smaller than the smallest allowable.
    public function testSeatsMinInvalid()
    {
        $value = $this->min_valid_int - 1;
        $this->airplane->seats = $value;
        $this->assertNotEquals($this->airplane->seats, $value);
    }

    //TESTS FOR REACH

    //Valid tests for reach

    //Reach number is the smallest allowable.
    public function testReachMinValid()
    {
        $value = $this->min_valid_int;
        $this->airplane->reach = $value;
        $this->assertEquals($this->airplane->reach, $value);
    }

    //Invalid tests for reach

    //Reach number is smaller than the smallest allowable.
    public function testReachMinInvalid()
    {
        $value = $this->min_valid_int - 1;
        $this->airplane->reach = $value;
        $this->assertNotEquals($this->airplane->reach, $value);
    }

    //TESTS FOR CRUISE

    //Valid tests for cruise
    //Cruise number is the smallest allowable
    public function testCruiseMinValid()
    {
        $value = $this->min_valid_int;
        $this->airplane->cruise = $value;
        $this->assertEquals($this->airplane->cruise, $value);
    }

    //Invalid tests for cruise

    //Cruise number is smaller than the smallest allowable.
    public function testCruiseMinInvalid()
    {
        $value = $this->min_valid_int - 1;
        $this->airplane->cruise = $value;
        $this->assertNotEquals($this->airplane->cruise, $value);
    }

    //TESTS FOR TAKEOFF

    //Valid tests for takeoff

    //Takeoff number is the smallest allowable
    public function testTakeoffMinValid()
    {
        $value = $this->min_valid_int;
        $this->airplane->takeoff = $value;
        $this->assertEquals($this->airplane->takeoff, $value);
    }

    //Invalid tests for takeoff

    //Takeoff number is smaller than the smallest allowable.
    public function testTakeoffMinInvalid()
    {
        $value = $this->min_valid_int - 1;
        $this->airplane->takeoff = $value;
        $this->assertNotEquals($this->airplane->takeoff, $value);
    }


    //TESTS FOR HOURLY

    //Valid tests for hourly

    //Hourly number is the smallest allowable.
    public function testHourlyMinValid() {
        $value = $this->min_valid_int;
        $this->airplane->hourly = $value;
        $this->assertEquals($this->airplane->hourly, $value);
    }

    //Invalid tests for hourly

    //Hourly number is smaller than the smallest allowable.
    public function testHourlyMinInvalid() {
        $value = $this->min_valid_int - 1;
        $this->airplane->hourly =  $value;
        $this->assertNotEquals($this->airplane->hourly, $value);
    }
}
