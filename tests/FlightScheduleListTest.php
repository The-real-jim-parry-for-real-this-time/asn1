<?php
if (! class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}
if (! class_exists('PHPUnit_Framework_ExpectationFailedException')) {
    class_alias('PHPUnit\Framework\ExpectationFailedException', 'PHPUnit_Framework_ExpectationFailedException');
}
/**
 * This test covers the flights collection class
 * FlightSchedule.php.
 *
 * @author Morris Arroyo
 */
class FlightScheduleListTest extends PHPUnit_Framework_TestCase
{
    private $CI;

    private $flights;

    //Earliest time for departure
    private $earliest_departure;

    //Latest time for arrival at home base
    private $latest_arrival;

    //Swallow base airport
    private $base;

    //Test setup.
    public function setUp()
    {
        $this->CI                   = &get_instance();
        $this->flights              = new FlightSchedule();
        $this->earliest_departure   = strtotime('08:00');
        $this->latest_arrival       = strtotime('22:00');
        $this->base                 = "YXT";
    }

    //Tests each plane to check if first flight is from base and leaves later than 08:00
    public function testDeparturesEarliest() {
        $failures = [];
        $first_flight = [];
        foreach($this->flights->all()  as $flight) {

            if (array_key_exists($flight->airplanes[0]->id, $first_flight)) {
                if(strtotime($first_flight[$flight->airplanes[0]->id]->depart_time)
                    > strtotime($flight->depart_time)) {

                    $first_flight[$flight->airplanes[0]->id] = $flight;
                }
            } else {
                $first_flight[$flight->airplanes[0]->id] = $flight;
            }
        }
        foreach($first_flight as $airplane => $flight) {
            try {
                $this->assertEquals($flight->depart_airport[0]->code, $this->base
                    , "First flight of airplane id". $airplane . " is not from base " . $this->base);
            } catch (PHPUnit_Framework_ExpectationFailedException $e){
                $failures[] = $e->getMessage();
            }
            try {
                $this->assertGreaterThanOrEqual($this->earliest_departure, strtotime($flight->depart_time)
                    , "First flight of airplane id" . $airplane . " is too early " . $flight->depart_time);
            } catch (PHPUnit_Framework_ExpectationFailedException $e){
                $failures[] = $e->getMessage();
            }
        }
        if(!empty($failures)) {
            throw new PHPUnit_Framework_ExpectationFailedException (
                count($failures) . " assertions failed:\n\t" . implode("\n\t", $failures)
            );
        }
    }

    //Tests each plane to check if last flight is to base and arrives earlier than 22:00
    public function testArrivalsLatest() {
        $failures = [];
        $first_flight = [];
        foreach($this->flights->all()  as $flight) {

            if (array_key_exists($flight->airplanes[0]->id, $first_flight)) {
                if(strtotime($first_flight[$flight->airplanes[0]->id]->arrive_time)
                    < strtotime($flight->arrive_time)) {

                    $first_flight[$flight->airplanes[0]->id] = $flight;
                }
            } else {
                $first_flight[$flight->airplanes[0]->id] = $flight;
            }
        }
        foreach($first_flight as $airplane => $flight) {
            try {
                $this->assertEquals($flight->arrive_airport[0]->code, $this->base
                    , "Last flight of airplane id". $airplane . " is not to base " . $this->base);
            } catch (PHPUnit_Framework_ExpectationFailedException $e){
                $failures[] = $e->getMessage();
            }
            try {
                $this->assertLessThanOrEqual($this->latest_arrival, strtotime($flight->arrive_time)
                    , "Last flight of airplane id" . $airplane . " is too late " . $flight->arrive_time);
            } catch (PHPUnit_Framework_ExpectationFailedException $e){
                $failures[] = $e->getMessage();
            }
        }
        if(!empty($failures)) {
            throw new PHPUnit_Framework_ExpectationFailedException (
                count($failures) . " assertions failed:\n\t" . implode("\n\t", $failures)
            );
        }
    }
}