<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Flights extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    //require_once '../models/Flights.php';

		$this->data['pagebody'] = 'flights_index';
		$this->data['flights'] = $this->flight->all();
		$this->render(); 
	}

}
