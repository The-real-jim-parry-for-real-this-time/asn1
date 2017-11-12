<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fleet extends Application
{
	/* public function index()
	{
		foreach ($this->Airplanes->all() as $airplane){
			$airplanes[] = (array) $airplane;
		}

		$this->data['pagebody'] = 'fleet_index';

		$this->data['fleet'] = $airplanes;
		
		$this->render();
	} */

	public function index()
	{
		$result = '';
		$role = $this->session->userdata('userrole');
		foreach ($this->Airplanes->all() as $airplane){
			if ($role == ROLE_OWNER)
				$result .= $this->parser->parse('fleet_index_itemx', (array) $airplane, true);
			else
				$result .= $this->parser->parse('fleet_index_item', (array) $airplane, true);
		}
		$this->data['add'] = null;
		if ($role == ROLE_OWNER) 
			$this->data['add'] .= $this->parser->parse('fleet_itemadd',[], true);
		$this->data['pagebody'] = 'fleet_index';
		$this->data['fl'] = $result;
		$this->render(); 
	}

	public function add()
	{
		$plane = $this->Airplanes->create();
		$this->session->set_userdata('plane', $plane);
		$this->showit();
	}

	public function edit($id = null)
	{
		if ($id == null)
			redirect('/Fleet');
		$plane = $this->Airplanes->get($id);
		$this->session->set_userdata('plane', $plane);
		$this->showit();
	}

	private function showit()
    {
        $this->load->helper('form');
		$plane = $this->session->userdata('plane');
		$this->data['id'] = $plane->id;

        // if no errors, pass an empty message
        if ( ! isset($this->data['error']))
			$this->data['error'] = '';

        $fields = array(
            'fmanufacturer' => form_label('manufacturer') 		. form_input('manufacturer', $plane->manufacturer),
            'fmodel' 		=> form_label('model') 	 			. form_input('model', $plane->model),
            'fprice'    	=> form_label('price') 		 		. form_input('price', $plane->price),
            'fseats' 		=> form_label('seats') 	 			. form_input('seats', $plane->seats),
            'freach'    	=> form_label('reach') 		 		. form_input('reach', $plane->reach),
            'fcruise'    	=> form_label('cruise') 		   	. form_input('cruise', $plane->cruise),
            'ftakeoff'    	=> form_label('takeoff') 		   	. form_input('takeoff', $plane->takeoff),
            'fhourly'    	=> form_label('hourly') 		   	. form_input('hourly', $plane->hourly),
            'zsubmit'    	=> form_submit('submit', 'Submit')
		);
        $this->data = array_merge($this->data, $fields);

        $this->data['pagebody'] = 'fleet_itemedit';
		$this->render();
	}

	public function submit()
	{
		// setup for validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->Airplanes->rules());
	
		// retrieve & update data transfer buffer
		$plane = (array) $this->session->userdata('plane');
		$plane = array_merge($plane, $this->input->post());
		$plane = (object) $plane;  // convert back to object
		$this->session->set_userdata('plane', (object) $plane);
		var_dump($plane->id);
		// validate away
		if ($this->form_validation->run())
		{
			if ($plane->id != 0 && empty($plane->id))
			{
				$plane->id = $this->Airplanes->highest() + 1;
				$this->Airplanes->add($plane);
				$this->alert('plane ' . $plane->id . ' added', 'success');
			} else
			{
				$this->Airplanes->update($plane);
				$this->alert('plane ' . $plane->id . ' updated', 'success');
			}
		} else
		{
			$this->alert('<strong>Validation errors!<strong><br>' . validation_errors(), 'danger');
		}
		$this->showit();
	}

	private function alert($message) {
        $this->load->helper('html');
        $this->data['error'] = heading($message,6,'style="color:red;"');
	}

	function cancel() {
		$this->session->unset_userdata('plane');
		redirect('/fleet');
	}

	function delete()
	{
		$dto = $this->session->userdata('plane');
		$plane = $this->Airplanes->get($dto->id);
		$this->Airplanes->delete($plane->id);
		$this->session->unset_userdata('plane');
		redirect('/Fleet');
	}

	public function show($key) {

		$this->data['pagebody'] = 'airplane';
		
		$this->data['airplane'][] = (array) $this->Airplanes->get($key);
		
        $this->render();
    }

}
