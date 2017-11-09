<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fleet extends Application
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
		$this->data['pagebody'] = 'fleet_index';

		$this->data['Fleet'] = $this->airplane->all();

		$this->render();
	}

	public function show($key) {

        $this->data['pagebody'] = 'Fleet';

        $this->data['Fleet'] = [$this->airplane->get($key)];

        $this->render();
    }

}
