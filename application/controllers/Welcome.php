<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
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
	function __construct()
    {
        parent::__construct();
    }


    public function index()
	{
		foreach ($this->Airplanes->all() as $airplane){
			$airplanes[] = (array) $airplane;
		}
		foreach ($this->FlightSchedule->all() as $flight){
			$flights[] = (array) $flight;
		}
		foreach ($this->Airport->all() as $airport) {
            if (strcmp($airport->type, 'dest') == 0) {
                $dest[] = (array) $airport;
            }
		}
		$base[]         = (array) $this->Airport->get(0);
		$this->data['pagebody'] = 'welcome_message';
	    $this->data['flights'] = $flights;
        $this->data['base'] = $base;
        $this->data['dest'] = $dest;
        $this->data['count'] = count($airplanes);
		$this->render();
	}

}
