<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FlightBooking extends Application{

	public function index(){
        $this->showBookingPage();
    }

    public function showBookingPage(){
        $this->load->helper('form');

        if ( ! isset($this->data['error']))
            $this->data['error'] = '';
        
		foreach ($this->Airport->all() as $airport){
            $airports[] = $airport->name;
        }
        array_unshift($airports, null);

        $fields = array(
            'fdepart' => form_dropdown('departAirport', $airports),
            'fdest'   => form_dropdown('destAirport', $airports),
            'fdest2'   => form_dropdown('dest2Airport', $airports),
            'fdest3'   => form_dropdown('dest3Airport', $airports),
            'zsubmit' => form_submit('submit', 'Search'),
        );
        $this->data = array_merge($this->data, $fields);
        
        $this->data['pagebody'] = 'flightBooking_index';
        
		$this->render();
    }
    
    public function search(){

        $this->load->library('form_validation');

        $config = array(
            ['field' => 'departAirport', 'label' => 'departAirport', 'rules' => 'greater_than[0]'],
            ['field' => 'destAirport', 'label' => 'destAirport', 'rules' => 'greater_than[0]'],
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){
            $this->alert('please choose a departure and destination airport');
            $this->showBookingPage();
            return 0;
        }
        
        $postData = (object)$this->input->post();
        $depart = $postData->departAirport-1;
        $dest = $postData->destAirport-1;
        $dest2 = $postData->dest2Airport-1;
        $dest3 = $postData->dest3Airport-1;

        if($dest2 == -1 && $dest3 != -1){
            $this->alert('please choose a secondary destination');
            $this->showBookingPage();
            return 0;
        }

        foreach ($this->FlightSchedule->all() as $flight){
            if($depart == $flight->depart_airport[0]->id && $dest == $flight->arrive_airport[0]->id)
                $flight1[] = (array)$flight;
            if($dest == $flight->depart_airport[0]->id && $dest2 == $flight->arrive_airport[0]->id)
                $flight2[] = (array)$flight;
            if($dest2 == $flight->depart_airport[0]->id && $dest3 == $flight->arrive_airport[0]->id)
                $flight3[] = (array)$flight;
        }

        if(empty($flight1)){
            $this->alert('no flights available matching your criteria');
            $this->showBookingPage();
            return 0;
        }
        if(empty($flight2) && $dest2 > -1){
            $this->alert('no flights available matching your criteria');
            $this->showBookingPage();
            return 0;
        }
        if(empty($flight3) && $dest3 > -1){
            $this->alert('no flights available matching your criteria');
            $this->showBookingPage();
            return 0;
        }
        $this->data['flights'] = $flight1;
        if(!empty($flight2)){
            $this->data['flights'] = array_merge($this->data['flights'], $flight2);
        }
        if(!empty($flight3)){
            $this->data['flights'] = array_merge($this->data['flights'], $flight3);
        }
        $this->data['pagebody'] = 'flightBooking_search';
        $this->render();
    }

    private function alert($message) {
        $this->load->helper('html');
        $this->data['error'] = heading($message,6,'style="color:red;"');
    }
}
