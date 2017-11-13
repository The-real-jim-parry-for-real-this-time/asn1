<?php
if (! class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

/**
 * This test covers the airport model.
 * Airport.php.
 *
 * @author Morris Arroyo
 */
class AirportTest extends PHPUnit_Framework_TestCase
{
    private $CI;

    private $airport;

    //Longest allowable string length
    private $max_valid_strlen;

    //Smallest allowable integer
    private $min_valid_int;

    //Airport code valid string length
    private $airport_code_strlen;

    //Largest possible latitude
    private $max_latitude;

    private $max_longitude;

    //Test setup.
    public function setUp()
    {
        $this->CI                    = &get_instance();
        $this->airport               = new Airport();
        $this->max_valid_strlen      = 64;
        $this->min_valid_int         = 0;
        $this->airport_code_strlen   = 3;
        $this->max_latitude          = 90.0;
        $this->max_longitude         = 180.0;
    }

    //TESTS FOR ID

    //Valid tests for Id

    //Id equal to 0
    public function testIdValid() {
        $value = 0;
        $this->airport->id = $value;
        $this->assertGreaterThanOrEqual($this->min_valid_int, $this->airport->id);
    }
    
    //Invalid tests for Id
    public function testIdInvalid() {
        $value = -1;
        $this->airport->id = $value;
        $this->assertNotEquals($value, $this->airport->id);
    }

    //TESTS FOR CODE

    public function testCodeType() {
        $value = "XYZ";
        $this->airport->code = $value;
        $this->assertInternalType('string', $this->airport->code);
    }

    //Valid tests for code

    //String length equal to valid number of chars
    public function testCodeStrlenValid()
    {
        $value = "XYZ";
        $this->airport->code = $value;
        $this->assertEquals(strlen($this->airport->code), $this->airport_code_strlen);
    }

    //String characters limited to capital letters
    public function testCodeCaseValid()
    {
        $value = "XYZ";
        $this->airport->code = $value;
        $this->assertTrue(ctype_upper($this->airport->code));
    }

    //Invalid tests for code

    //String length is invalid number of characters;
    public function testCodeStrlenInvalid()
    {
        $value = "YZ";
        $this->airport->code = $value;
        $this->assertNotEquals($this->airport->code, $value);
        $value = "WXYZ";
        $this->airport->code = $value;
        $this->assertNotEquals($this->airport->code, $value);
    }

    //String characters contains lower case letters
    public function testCodeCaseInvalid()
    {
        $value = "xYz";
        $this->airport->code = $value;
        $this->assertNotEquals($this->airport->code, $value);
    }
    
    //TESTS FOR TYPE
    // Valid tests for type

    // String equal to max allowable
    public function testTypeMaxLengthValid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen; $i++) {
            $value .= "m";
        }
        $this->airport->type = $value;
        $this->assertLessThanOrEqual($this->max_valid_strlen, strlen($this->airport->type));
    }

    // Invalid tests for type

    // Longer string than max allowable.
    public function testTypeMaxLengthInvalid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen + 1; $i++) {
            $value .= "m";
        }
        $this->airport->type = $value;
        $this->assertNotEquals($value, $this->airport->type);
    }
    
    //TESTS FOR NAME
    
    // Valid tests for name

    // String equal to max allowable
    public function testNameMaxLengthValid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen; $i++) {
            $value .= "m";
        }
        $this->airport->name = $value;
        $this->assertLessThanOrEqual($this->max_valid_strlen, strlen($this->airport->name));
    }

    // Invalid tests for name

    // Longer string than max allowable.
    public function testNameMaxLengthInvalid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen + 1; $i++) {
            $value .= "m";
        }
        $this->airport->name = $value;
        $this->assertNotEquals($value, $this->airport->name);
    }

    //TESTS FOR LATITUDE

    //Valid tests for latitude

    //Latitude equal to 90
    public function testLatitudeMaxValid() {
        $value = 90;
        $this->airport->latitude = $value;
        $this->assertLessThanOrEqual($this->max_latitude, $this->airport->latitude);
    }

    //Latitude equal to -90
    public function testLatitudeMinValid() {
        $value = -90;
        $this->airport->latitude = $value;
        $this->assertLessThanOrEqual($this->max_latitude, abs($this->airport->latitude));
    }
    
    //Invalid tests for latitude

    //Latitude greater than 90
    public function testLatitudeMaxInvalid() {
        $value = 91;
        $this->airport->latitude = $value;
        $this->assertNotEquals($value, $this->airport->latitude);
    }

    //Latitude less than -90
    public function testLatitudeMinInvalid() {
        $value = -91;
        $this->airport->latitude = $value;
        $this->assertNotEquals($value, $this->airport->latitude);
    }
    
    //TESTS FOR LONGITUDE

    //Valid tests for longitude

    //Longitude equal to 180
    public function testLongitudeMaxValid() {
        $value = 180;
        $this->airport->longitude = $value;
        $this->assertLessThanOrEqual($this->max_longitude, $this->airport->longitude);
    }

    //Longitude equal to -180
    public function testLongitudeMinValid() {
        $value = -180;
        $this->airport->longitude = $value;
        $this->assertLessThanOrEqual($this->max_longitude, abs($this->airport->longitude));
    }
    
    //Invalid tests for longitude

    //Longitude greater than 180
    public function testLongitudeMaxInvalid() {
        $value = 181;
        $this->airport->longitude = $value;
        $this->assertNotEquals($value, $this->airport->longitude);
    }

    //Longitude less than -180
    public function testLongitudeMinInvalid() {
        $value = -181;
        $this->airport->longitude = $value;
        $this->assertNotEquals($value, $this->airport->longitude);
    }
}