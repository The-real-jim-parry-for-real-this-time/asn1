<?php
require_once APPPATH . 'core/Entity.php';
/**
 * This is the model for an airport
 *
 * @author Brayden Traas
 */
class Airport extends Entity
{
    protected $id;
    protected $code;
    protected $type;
    protected $name;

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

    public function setId($value) {

        // check valid character type
        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if(strlen($value) > 64) {
            return;
        }

        $this -> id = $value;
    }

    public function setCode($value){

        $alNum = preg_replace('/[^a-z0-9 ]/i', '', $value);
        if($value != $alNum) return;

        if(strlen($value) > 64) {
            return;
        }

        $this -> code = $value;
    }

    public function setType($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> type = $value;
    }


    public function setName($value){

        $alNum = preg_replace('/[^0-9]/i', '', $value);
        if($value != $alNum) return;

        if($value != intval($value)) return;

        $this -> name = $value;
    }



}