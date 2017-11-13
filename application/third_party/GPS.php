<?php

/**
 * GPS enables developers to convert between different coordinate systems
 *
 * @category  Smp
 * @package   GPS
 * @license   https://github.com/nexces/Smp/blob/master/LICENSE.txt    BSD License
 * @author    Adrian 'Nexces' Piotrowicz / adrianp
 */
class GPS {

    /**
     * Decimal format of coordinate
     * @var int
     */
    const FORMAT_DEC = 10;

    /**
     * DMS (Degrees, Minutes, Seconds)
     * @var int
     */
    const FORMAT_DMS = 11;

    /**
     * MinDec(Degrees, Minutes, Decimal Minutes)
     * @var int
     */
    const FORMAT_MINDEC = 12;

    const SIGN_DEG = '°';
    const SIGN_MIN = '\'';
    const SIGN_SEC = '"';

    private $latitude;
    private $longitude;

    public function getLatitude($format = self::FORMAT_DEC)
    {
        $direction = ($this->latitude > 0 ? 'N' : 'S');
        return $this->_getFormated($direction, $this->latitude, $format);
    }

    public function setLatitude($value, $format = self::FORMAT_DEC)
    {
        $this->latitude = $this->_getDecimal($value, $format);
        return $this;
    }

    public function getLongitude($format = self::FORMAT_DEC)
    {
        $direction = ($this->longitude > 0 ? 'E' : 'W');
        return $this->_getFormated($direction, $this->longitude, $format);
    }

    public function setLongitude($value, $format = self::FORMAT_DEC)
    {
        $this->longitude = $this->_getDecimal($value, $format);
        return $this;
    }

    private function _getDecimal($value, $format)
    {
        switch ($format) {
            case self::FORMAT_DMS:
                return $this->_fromDMS($value);
                break;

            case self::FORMAT_MINDEC:
                return $this->_fromMinDec($value);
                break;

            case self::FORMAT_DEC:
                return (float) $value;
                break;

            default:
                throw new Exception(
                    'Unknown format requested');
        }
    }

    /**
     * Returns formated decimal coordinate to specified format
     * @param string $direction
     * @param int $value
     * @param int $format
     * @return string
     */
    private function _getFormated($direction, $value, $format)
    {
        switch ($format) {
            case self::FORMAT_DMS:
                return $this->_toDMS($value) . $direction;
                break;

            case self::FORMAT_MINDEC:
                return $this->_toMinDec($value) . $direction ;
                break;

            case self::FORMAT_DEC:
            default:
                return $value;
                break;
        }

        return $value;

    }

    /**
     * Converts coordinate from DMS format to Decimal format
     * @param string $dms
     * @return float
     * @throws Exception
     */
    public static function fromDMS($dms)
    {
        $dms_parts = array();
        $dms_direction = array();

        $regexp_direction = '/[wens]/i';
        $regexp_coords = '/^(\d{1,3})(\D+([0-6]?\d)\D+([0-6]?\d(\.(\d+))?\D+)?)?$/';

        $dms_unidirectional = trim(str_ireplace(array('w', 'e', 'n', 's'), '', $dms));

        //echo $regexp_coords . " " . $dms_unidirectional . " ";

        $matches_coords = preg_match($regexp_coords, $dms_unidirectional, $dms_parts);

        $matches_direction = preg_match($regexp_direction, $dms, $dms_direction);

        if ($matches_coords === FALSE) {
            throw new Exception(
                'Coordinates regexp error');
        }
        if ($matches_direction === FALSE) {
            throw new Exception(
                'Direction regexp error');
        }

        if ($matches_coords == 0 || $matches_direction == 0) {
            throw new Exception(
                "Supplied coordinates are not in DMS format: $matches_coords, $matches_direction");
        }

        array_unshift($dms_parts, $dms_direction[0]);

        $decimal =
            ((strtolower($dms_parts[0]) == 's' || strtolower($dms_parts[0]) == 'w') ? '-' : '') .
            (
                (int) $dms_parts[2]
                +
                (isset($dms_parts[3])
                    ? (
                        ((int) $dms_parts[4] * 60)
                        +
                        (isset($dms_parts[5])
                            ? (float) $dms_parts[5]
                            : 0)
                    ) / 3600
                    : 0
                )
            )
        ;

        return (float) $decimal;
    }


    /**
     * @param $lat1
     * @param $lon1
     * @param $lat2
     * @param $lon2
     * @return float meters
     */
    public static function getDistanceBetween( $lat1, $lon1, $lat2, $lon2 ) // return: meters {{{
    {
        // Returns the "crow-flies" distance (in metres) between two GPS coordinates
        // XXX  This is a ROUGH estimate!!!!   It may be off by 10% or more.
        // XXX  It does not consider elevation differences between the two points.

        // This algorithm is courtesy of http://sgowtham.net/blog/2009/08/04/php-calculating-distance-between-two-locations-given-their-gps-coordinates/  {{{

        $earthRadius = 3960.00;			// Miles

        $d = sin( deg2rad( $lat1 ) ) * sin( deg2rad( $lat2 ) ) + cos( deg2rad( $lat1 ) ) * cos( deg2rad( $lat2 ) ) * cos( deg2rad( $lon2-$lon1 ) );
        $d = acos( $d );
        $d = rad2deg( $d );
        $d = $d * 60 * 1.1515;			// 60 nautical miles per degree separation of longitudes.  One nautical mile = 1.1515 statute mile.
        $d = round( $d, 4 );
        // }}}

        // Convert miles to KM's...
        $d = $d * 1.60934;

        // Convert KM's to M's...
        $d = $d * 1000;

        return ceil( $d );				// Round up to nearest whole meter

    } // }}}


    /**
     * Converts coordinate from MinDec format to Decimal format
     * @param string $mindec
     * @return float
     * @throws Exception
     */
    private function _fromMinDec($mindec)
    {

        $mindec_parts = array();
        $mindec_direction = array();

        $regexp_direction = '/[wens]/i';
        $regexp_coords = '/^(\d{1,2})(\D+([0-6]?\d)(\.(\d+))?\D+)?$/i';

        $mindec_unidirectional = trim(str_ireplace(array('w', 'e', 'n', 's'), '', $mindec));
        $matches_coords = preg_match($regexp_coords, $mindec_unidirectional, $mindec_parts);

        $matches_direction = preg_match($regexp_direction, $mindec, $mindec_direction);

        if ($matches_coords === FALSE) {
            throw new Exception(
                'Coordinates regexp error');
        }
        if ($matches_direction === FALSE) {
            throw new Exception(
                'Direction regexp error');
        }

        if ($matches_coords == 0 || $matches_direction == 0) {
            throw new Exception(
                'Supplied coordinates are not in MinDec format');
        }

        array_unshift($mindec_parts, $mindec_direction[0]);

        $decimal =
            ((strtolower($mindec_parts[0]) == 's' || strtolower($mindec_parts[0]) == 'w') ? '-' : '') .
            (
                (int) $mindec_parts[2]
                +
                (isset($mindec_parts[3])
                    ? (
                    (float) $mindec_parts[3]
                    ) / 60
                    : 0
                )
            )
        ;

        return (float) $decimal;

    }

    /**
     * Unidirectional conversion from Decimal format to DMS format
     * @param float $decimal
     * @return string
     */
    private function _toDMS($decimal)
    {
        $decimal = abs($decimal);

        $dms = (int) $decimal . self::SIGN_DEG;

        if ((string) ((int) $decimal) == (string) $decimal) {
            return $dms;
        }

        $minutes = ($decimal - (int) $decimal) * 60;

        $dms .= '' . str_pad((int) ($minutes), 2, '0', STR_PAD_LEFT) . self::SIGN_MIN;

        if ((string) ((int) $minutes) == (string) $minutes) {
            return $dms;
        }

        $seconds = ($minutes - (int) $minutes) * 60;

        $dms .= '' . number_format($seconds, 3)  . self::SIGN_SEC;


        return (string) $dms;
    }

    /**
     * Unidirectional conversion from Decimal format to MinDec format
     * @param float $decimal
     * @return string
     */
    private function _toMinDec($decimal)
    {
        $decimal = abs($decimal);

        $dms = (int) $decimal . self::SIGN_DEG;

        if ((string) ((int) $decimal) == (string) $decimal) {
            return $dms;
        }

        $minutes = ($decimal - (int) $decimal) * 60;

        $dms .= '' . str_pad(number_format($minutes, 6), 9, '0', STR_PAD_LEFT) . self::SIGN_MIN;

        return (string) $dms;
    }
}