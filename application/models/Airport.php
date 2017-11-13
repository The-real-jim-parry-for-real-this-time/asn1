<?php
require_once APPPATH . 'core/Entity.php';
require_once APPPATH . 'third_party/GPS'; // this is the model for an airport

/**
 *
 * @author Brayden Traas
 */
class Airport extends Entity
{

    //private static $identifier = "S";


    protected $id;
    protected $code;
    protected $type;
    protected $name;
    protected $latitide;
    protected $longitude;

//
// $config = array(
//['field' => 'id', 'label' => 'Airports', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
//['field' => 'code', 'label' => 'Code', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
//['field' => 'type', 'label' => 'Type', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
//['field' => 'name', 'label' => 'Name', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
//);

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $value Integer
     */
    public function setId($value) {

        // check valid character type
        $num = preg_replace('/[^0-9]/i', '', $value);
        if($value != $num) return;

        if(strlen($value) > 64) {
            return;
        }


        $this -> id = $value;
    }

    /**
     * @param $value String code (eg XYZ)
     */
    public function setCode($value){

        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if(strlen($value) > 64) {
            return;
        }

        //if($alNum[0] != self::$identifier) return;


        $this -> code = $value;
    }

    /**
     * @param $value integer
     */
    public function setType($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> type = $value;
    }


    /**
     * @param $value integer
     */
    public function setName($value){

        $alNum = preg_replace('/[^0-9A-Z _\'-]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> name = $value;
    }




    /**
     * Parse a latitude from a Unicode-encoded coordinate (with degrees etc)
     *
     * // Not yet completed
     *
     * @param $coordinates
     * @return mixed
     */
    public static function parseFromCoordinates($coordinates)
    {
        $decoded = Entity::decodeUnicode($coordinates);

        $parts = preg_split('/([NEWS])/', $decoded, -1, PREG_SPLIT_DELIM_CAPTURE);
        $points = array();
        for ($i=0, $n=count($parts)-1; $i<$n; $i+=2) {
            $points[] = $parts[$i].$parts[$i+1];
        }
        if ($parts[$n] != '') {
            $points[] = $parts[$n];
        }


        print_r($points);

        //echo GPS::fromDMS($points[0]);
        //echo GPS::fromDMS($points[1]);

        return [GPS::fromDMS($points[0]), GPS::fromDMS($points[1])];

        //return $decoded;

    }

//    public static function DMS2Decimal($degrees = 0, $minutes = 0, $seconds = 0, $direction = 'n') {
//        //converts DMS coordinates to decimal
//        //returns false on bad inputs, decimal on success
//
//        //direction must be n, s, e or w, case-insensitive
//        $d = strtolower($direction);
//        $ok = array('n', 's', 'e', 'w');
//
//        //degrees must be integer between 0 and 180
//        if(!is_numeric($degrees) || $degrees < 0 || $degrees > 180) {
//            $decimal = false;
//        }
//        //minutes must be integer or float between 0 and 59
//        elseif(!is_numeric($minutes) || $minutes < 0 || $minutes > 59) {
//            $decimal = false;
//        }
//        //seconds must be integer or float between 0 and 59
//        elseif(!is_numeric($seconds) || $seconds < 0 || $seconds > 59) {
//            $decimal = false;
//        }
//        elseif(!in_array($d, $ok)) {
//            $decimal = false;
//        }
//        else {
//            //inputs clean, calculate
//            $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);
//
//            //reverse for south or west coordinates; north is assumed
//            if($d == 's' || $d == 'w') {
//                $decimal *= -1;
//            }
//        }
//
//        return $decimal;
//    }


    /**
     * @param $value double latitude  (decimal format)
     */
    public function setLatitude($value) {

        $num = preg_replace('/[^0-9.-]/i', '', $value);
        if($value != $num) return;

        if($value != doubleval($value)) return;

        $this->latitide = $value;
    }

    /**
     * @param $value double Longitude (decimal format)
     */
    public function setLongitude($value) {


        $num = preg_replace('/[^0-9.-]/i', '', $value);
        if($value != $num) return;

        if($value != doubleval($value)) return;


        $this->longitude = $value;
    }


}