<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonitoringPage extends CI_Controller {

	function __construct() {  
        parent::__construct();
        $this->load->model('MonitoringPage_model');
    }
    public function index() {
        // $this->load->view('template/header');
        // $this->load->view('footer');
        $data['pcjournals'] = $this->pcjournals();
        $this->load->view('monitoringPage_view',$data);
    }
    public function pcjournals() {
    	return $this->MonitoringPage_model->pcjournals_model();
    }

}