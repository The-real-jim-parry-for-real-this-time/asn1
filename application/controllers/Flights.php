<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Flights extends Application
{
	public function index()
	{
		$result = '';
		$role = $this->session->userdata('userrole');
		foreach ($this->FlightSchedule->all() as $flight){
			if ($role == ROLE_OWNER)
				$result .= $this->parser->parse('flights_index_itemx', (array) $flight, true);
			else
				$result .= $this->parser->parse('flights_index_item', (array) $flight, true);
		}
		$this->data['add'] = null;
		if ($role == ROLE_OWNER) 
			$this->data['add'] .= $this->parser->parse('flights_itemadd',[], true);
		$this->data['pagebody'] = 'flights_index';
		$this->data['f'] = $result;
		$this->render(); 
	}

	public function add()
	{
		$flight = $this->FlightSchedule->create();
		$flight->airplanes = [$this->Airplanes->get(0)];
		$flight->depart_airport = [$this->Airport->get(0)];
		$flight->arrive_airport = [$this->Airport->get(0)];
		$this->session->set_userdata('flight', $flight);
		$this->showit();
	}

	public function edit($id = null)
	{
		if ($id == null)
			redirect('/Flights');
		$flight = $this->FlightSchedule->get($id);
		$this->session->set_userdata('flight', $flight);
		$this->showit();
	}

	private function showit()
    {
        $this->load->helper('form');
		$flight = $this->session->userdata('flight');
		$this->data['id'] = $flight->id;

		foreach($this->Airplanes->all() as $airplane){
			$airplanes[] = $airplane->manufacturer . " " . $airplane->model;
		}
		foreach($this->Airport->all() as $airport){
			$airports[] = $airport->name;
		}
        // if no errors, pass an empty message
        if ( ! isset($this->data['error']))
			$this->data['error'] = '';
			
		if (is_object($flight->airplanes[0])){
			$fields = array(
				'fairplanes'  	  => form_label('airplanes') 		 . form_dropdown('airplanes', $airplanes, $flight->airplanes[0]->id),
				'fdepart_airport' => form_label('depart airport') 	 . form_dropdown('depart_airport', $airports, $flight->depart_airport[0]->id),
				'fdepart_time'    => form_label('depart time') 		 . form_input('depart_time', $flight->depart_time),
				'farrive_airport' => form_label('arrive airport') 	 . form_dropdown('arrive_airport', $airports, $flight->arrive_airport[0]->id),
				'farrive_time'    => form_label('arrive time') 		 . form_input('arrive_time', $flight->arrive_time),
				'zsubmit'    	  => form_submit('submit', 'Submit'),
			);
		} else {
			$fields = array(
				'fairplanes'  	  => form_label('airplanes') 		 . form_dropdown('airplanes', $airplanes, $flight->airplanes),
				'fdepart_airport' => form_label('depart airport') 	 . form_dropdown('depart_airport', $airports, $flight->depart_airport),
				'fdepart_time'    => form_label('depart time') 		 . form_input('depart_time', $flight->depart_time),
				'farrive_airport' => form_label('arrive airport') 	 . form_dropdown('arrive_airport', $airports, $flight->arrive_airport),
				'farrive_time'    => form_label('arrive time') 		 . form_input('arrive_time', $flight->arrive_time),
				'zsubmit'    	  => form_submit('submit', 'Submit'),
			);
		}
        $this->data = array_merge($this->data, $fields);
        $this->data['pagebody'] = 'flights_itemedit';
        $this->render();
	}
	
	public function submit()
	{
		// setup for validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->FlightSchedule->rules());

		$post = $this->input->post();
		// retrieve & update data transfer buffer
		$flight = (array) $this->session->userdata('flight');
		$flight = array_merge($flight, $post);
		$flight = (object) $flight;  // convert back to object
		$this->session->set_userdata('flight', $flight);
	
		// validate away
		if ($this->form_validation->run())
		{
			if (empty($flight->id))
			{
				$flight->id = $this->FlightSchedule->highest() + 1;
				$flight->code = "S00" . (string)($this->FlightSchedule->highest() + 2);
				$this->cleanUp();
				$this->FlightSchedule->add($flight);
				$this->alert('Flight ' . $flight->code . ' added', 'success');
			} else
			{
				$this->cleanUp();
				$this->FlightSchedule->update($flight);
				$this->alert('Flight ' . $flight->code . ' updated', 'success');
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
		$this->session->unset_userdata('task');
		redirect('/Flights');
	}

	function delete()
	{
		$dto = $this->session->userdata('flight');
		$flight = $this->FlightSchedule->get($dto->id);
		$flight->airplanes = $dto->airplanes[0]->id;
		$flight->depart_airport = $dto->depart_airport[0]->id;
		$flight->arrive_airport = $dto->arrive_airport[0]->id;
		$this->cleanUp();
		$this->FlightSchedule->delete($flight->id);
		$this->session->unset_userdata('flight');
		redirect('/Flights');
	}

	function cleanUp(){
		foreach($this->FlightSchedule->all() as $val){
			if(is_object($val->airplanes[0])){
				$this->FlightSchedule->get($val->id)->airplanes = $val->airplanes[0]->id;
			}
			if(is_object($val->depart_airport[0])){
				$this->FlightSchedule->get($val->id)->depart_airport = $val->depart_airport[0]->id;
			}
			if(is_object($val->arrive_airport[0])){
				$this->FlightSchedule->get($val->id)->arrive_airport = $val->arrive_airport[0]->id;
			}
		}
	}

	function expandRelations(){
		foreach($this->FlightSchedule->all() as $val){
			if(!is_object($val->airplanes[0])){
				$this->FlightSchedule->get($val->id)->airplanes = $val->airplanes;
			}
			if(!is_object($val->depart_airport[0])){
				$this->FlightSchedule->get($val->id)->depart_airport = $val->depart_airport;
			}
			if(!is_object($val->arrive_airport[0])){
				$this->FlightSchedule->get($val->id)->arrive_airport = $val->arrive_airport;
			}
		}
	}

}
