<?php
if (! class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

/**
 * This test covers the flight model.
 * Flight.php.
 *
 * @author Morris Arroyo
 */
class FlightTest extends PHPUnit_Framework_TestCase
{
    private $CI;

    private $flight;

    private $first_char;

    private $max_valid_strlen;

    private $earliest_departure;

    private $latest_arrival;

    private $wait_time;

    private $buffer_time;

    private $airport_code_strlen;

    //Test setup.
    public function setUp()
    {
        $this->CI                   = &get_instance();
        $this->flight               = new Flight();
        $this->first_char           = "S";
        $this->max_valid_strlen     = 64;
        $this->earliest_departure   = "08:00";
        $this->latest_arrival       = "22:00";
        $this->wait_time            = 30;
        $this->buffer_time          = 10;
        $this->airport_code_strlen  = 3;



    }

    //TESTS FOR CODE

    //Valid tests for code

    //String length equal to max allowable
    public function testCodeMaxLengthValid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen; $i++) {
            $value .= $this->first_char;
        }
        $this->flight->code = $value;
        $this->assertLessThanOrEqual($this->max_valid_strlen, strlen($this->flight->code));
    }

    //String characters limited to alphanumeric characters
    public function testCodeCharsValid()
    {
        $value = $this->first_char . "abcde12345";
        $this->flight->code = $value;
        $this->assertTrue(ctype_alnum($this->flight->code));
    }

    //First character equal to fist character of group name
    public function testCodeFirstCharValue()
    {
        $value = $this->first_char ."0000";
        $this->flight->code = $value;
        $this->assertStringStartsWith($this->first_char, $this->flight->code);
    }

    //Invalid tests for code

    //String longer than max allowable
    public function testCodeMaxLengthInvalid()
    {
        $value = "";
        for ($i = 0; $i < $this->max_valid_strlen + 1; $i++) {
            $value .= $this->first_char;
        }
        $this->flight->code = $value;
        $this->assertLessThanOrEqual($this->max_valid_strlen, strlen($this->flight->code));
    }

    //String characters including symbols and punctuation
    public function testCodeCharsInvalid()
    {
        $value = $this->first_char . "abcde!@#$%^&*()_+{}:\" <>?~`-=[];\',./\\";
        $this->flight->code = $value;
        $this->assertNotEquals($this->flight->code, $value);
    }

    //First character is random alphanumeric character
    public function testCodeFirstCharInvalid()
    {
        $value = "x00000";
        $this->flight->code = $value;
        $this->assertNotEquals($this->flight->code, $value);
    }

    //TESTS FOR AIRPLANES
    /*
     *
     * TO BE IMPLEMENTED
     *
     */

    //TESTS FOR DEPARTAIRPORT

    //Valid tests for departAirport

    //String length equal to valid number of chars
    public function testDepartAirportStrlenValid()
    {
        $value = "XYZ";
        $this->flight->departAirport = $value;
        $this->assertEquals(strlen($this->flight->departAirport), $this->airport_code_strlen);
    }

    //String characters limited to capital letters

    //String characters limited to capital letters
    public function testDepartAirportCaseValid()
    {
        $value = "XYZ";
        $this->flight->departAirport = $value;
        $this->assertTrue(ctype_upper($this->flight->departAirport));
    }

    //Invalid tests for departAirport

    //String length is invalid number of characters;
    public function testDepartAirportStrlenInvalid()
    {
        $value = "YZ";
        $this->flight->departAirport = $value;
        $this->assertNotEquals($this->flight->departAirport, $value);
        $value = "WXYZ";
        $this->flight->departAirport = $value;
        $this->assertNotEquals($this->flight->departAirport, $value);
    }

    //String characters contains lower case letters
    public function testDepartAirportCaseInvalid()
    {
        $value = "xYz";
        $this->flight->departAirport = $value;
        $this->assertNotEquals($this->flight->departAirport, $value);
    }

    //TESTS FOR ARRIVEAIRPORT

    //Valid tests for departAirport

    //String length equal to valid number of chars
    public function testArriveAirportStrlenValid()
    {
        $value = "XYZ";
        $this->flight->arriveAirport = $value;
        $this->assertEquals(strlen($this->flight->arriveAirport), $this->airport_code_strlen);
    }

    //String characters limited to capital letters

    //String characters limited to capital letters
    public function testArriveAirportCaseValid()
    {
        $value = "XYZ";
        $this->flight->arriveAirport = $value;
        $this->assertTrue(ctype_upper($this->flight->arriveAirport));
    }

    //Invalid tests for departAirport

    //String length is invalid number of characters;
    public function testArriveAirportStrlenInvalid()
    {
        $value = "YZ";
        $this->flight->arriveAirport = $value;
        $this->assertNotEquals($this->flight->arriveAirport, $value);
        $value = "WXYZ";
        $this->flight->arriveAirport = $value;
        $this->assertNotEquals($this->flight->arriveAirport, $value);
    }

    //String characters contains lower case letters
    public function testArriveAirportCaseInvalid()
    {
        $value = "xYz";
        $this->flight->arriveAirport = $value;
        $this->assertNotEquals($this->flight->arriveAirport, $value);
    }
}