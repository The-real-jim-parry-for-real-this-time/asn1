<?php
/**
 * Created by PhpStorm.
 * User: kimdongwon
 * Date: 2017-11-02
 * Time: 1:20 PM
 */
class Entity extends CI_Model {

    // If this class has a setProp method, use it, else modify the property directly
    public function __set($key, $value) {


        //echo "set($key, $value)\n";
        //var_dump($key);

        // if a set* method exists for this key, 
        // use that method to insert this value. 
        // For instance, setName(...) will be invoked by $object->name = ...
        // and setLastName(...) for $object->last_name =
        $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));



        if (method_exists($this, $method)) {
           // echo "calling $method\n";
          //  var_dump($method);
            $this->$method($value);
          //  echo "new value: " . $this->$key . PHP_EOL;
            return $this;
        }

        //echo "not calling $method\n";
        //var_dump($method);

        // Otherwise, just set the property value directly.
        $this->$key = $value;
        return $this;
    }

    public function __get($key){

        if(!isset($this -> $key))
            return null;

        // and setLastName(...) for $object->last_name =
        $method = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));



        if (method_exists($this, $method)) {

            return $this->$method();
        }

        return $this->$key;
    }


    public static function decodeUnicode($str)
    {

        $str = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $str);

        return $str;
    }

}