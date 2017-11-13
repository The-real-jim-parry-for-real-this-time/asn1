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

    //Valid first character for identifiers (S for Swallow)
    private $first_char;

    //Longest allowable string length
    private $max_valid_strlen;

    //Smallest allowable integer
    private $min_valid_int;

    //Earliest time for departure
    private $earliest_departure;

    //Latest time for arrival at home base
    private $latest_arrival;

    //Loading wait time between flights
    private $wait_time;

    //Buffer time for getting up to cruise speed and slowing down
    private $buffer_time;

    //Airport code valid string length
    private $airport_code_strlen;

    //Test setup.
    public function setUp()
    {
        $this->CI                   = &get_instance();
        $this->flight               = new Flight();
        $this->first_char           = "S";
        $this->max_valid_strlen     = 64;
        $this->min_valid_int        = 0;
        $this->earliest_departure   = strtotime('08:00');
        $this->latest_arrival       = strtotime('22:00');
        $this->wait_time            = 30;
        $this->buffer_time          = 10;
        $this->airport_code_strlen  = 3;



    }
    //TESTS FOR ID

    //Valid tests for Id

    //Id equal to 0
    public function testIdValid() {
        $value = 0;
        $this->flight->id = $value;
        $this->assertGreaterThanOrEqual($this->min_valid_int, $this->flight->id);
    }

    //Invalid tests for Id

    //Id equal to less than 0
    public function testIdInvalid() {
        $value = -1;
        $this->flight->id = $value;
        $this->assertNotEquals($value, $this->flight->id);
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
        $this->assertNotEquals($value, strlen($this->flight->code));
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
        $this->assertNotEquals($value, $this->flight->code);
    }

    //TESTS FOR AIRPLANE

    //Valid tests for airplane

    //Airplane (ID) equal to 0
    public function testAirplaneValid() {
        $value = 0;
        $this->flight->airplane = $value;
        $this->assertGreaterThanOrEqual($this->min_valid_int, $this->flight->airplane);
    }

    //Invalid tests for airplane

    //Airplane (ID) equal to less than 0
    public function testAirplaneInvalid() {
        $value = -1;
        $this->flight->airplane = $value;
        $this->assertNotEquals($value, $this->flight->airplane);
    }

    //TESTS FOR DEPARTAIRPORT

    public function testDepartAirportType() {
        $value = "XYZ";
        $this->flight->departAirport = $value;
        $this->assertInternalType('string', $this->flight->departAirport);
    }

    //Valid tests for departAirport

    //String length equal to valid number of chars
    public function testDepartAirportStrlenValid()
    {
        $value = "XYZ";
        $this->flight->departAirport = $value;
        $this->assertEquals(strlen($this->flight->departAirport), $this->airport_code_strlen);
    }

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

    //TESTS FOR DEPARTTIME

    public function testDepartTimeType() {
        $value = $this->earliest_departure;
        $this->flight->departTime = $value;
        $this->assertInternalType('int', $this->flight->departTime);
    }

    //Valid tests for departTime

    //String is earliest departure time
    public function testDepartTimeEarliestValid() {
        $value = $this->earliest_departure;
        $this->flight->departTime = $value;
        $this->assertGreaterThanOrEqual($this->flight->departTime, $this->earliest_departure);
    }

    //Departure time string is earlier than arrival time
    public function testDepartTimeEarlierThanArriveTimeValid() {
        $value1 = strtotime('22:00');
        $this->flight->arriveTime = $value1;
        $value2 = strtotime('21:59');
        $this->flight->departTime = $value2;
        $this->assertLessThan($this->flight->arriveTime, $this->flight->departTime);
    }

    //Invalid tests for departTime

    //String is earlier than earliest depature time
    public function testDepartTimeEarliestInvalid() {
        $value = strtotime('7:59');
        $this->flight->departTime = $value;
        $this->assertNotEquals($this->flight->departTime, $value);
    }

    //Departure string is later than arrival time
    public function testDepartTimeLaterThanArriveTimeInvalid() {
        $value1 = strtotime('21:59');
        $this->flight->arriveTime = $value1;
        $value2 = strtotime('22:00');
        $this->flight->departTime = $value2;
        $this->assertNotEquals($value2, $this->flight->departTime);
    }

    //TESTS FOR ARRIVEAIRPORT

    public function testArriveAirportType() {
        $value = "XYZ";
        $this->flight->arriveAirport = $value;
        $this->assertInternalType('string', $this->flight->arriveAirport);
    }

    //Valid tests for arriveAirport

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
    
    //TESTS FOR ARRIVETIME

    public function testArriveTimeType() {
        $value = strtotime('22:00');
        $this->flight->arriveTime = $value;
        $this->assertInternalType('int', $this->flight->arriveTime);
    }

    //Valid tests for departTime

    //String is earliest departure time
    public function testArriveTimeLastestValid() {
        $value = strtotime('22:00');
        $this->flight->arriveTime = $value;
        $this->assertLessThanOrEqual($this->latest_arrival, $this->flight->departTime);
    }

    //Arrival time string is later than arrival time
    public function testArriveTimeLaterThanDepartTimeValid() {
        $value1 = strtotime('21:59');
        $this->flight->departTime = $value1;
        $value2 = strtotime('22:00');
        $this->flight->arriveTime = $value2;
        $this->assertGreaterThan($this->flight->departTime, $this->flight->arriveTime);
    }

    //Invalid tests for departTime

    //String is earlier than earliest depature time
    public function testArriveTimeLatestInvalid() {
        $value = '22:01';
        $this->flight->arriveTime = $value;
        $this->assertNotEquals($value, $this->flight->arrivetTime);
    }

    //Departure string is later than arrival time
    public function testArriveTimeEarlierThanDepartTimeInvalid() {
        $value1 = strtotime('22:00');
        $this->flight->departTime = $value1;
        $value2 = strtotime('21:59');
        $this->flight->arriveTime = $value2;
        $this->assertNotEquals($value2, $this->flight->arriveTime, "arriveTime is set with invalid value");
    }
}