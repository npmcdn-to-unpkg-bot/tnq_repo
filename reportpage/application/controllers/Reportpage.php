<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportpage extends CI_Controller {

	function __construct() {  
        parent::__construct();  
    }  

    public function index() {
        $this->load->view('reportPage_view');
    }

    public function getreportdetails() {
    	$report = $this ->input -> post('report');
        $startDate = $this ->input -> post('startDate');
        $endDate = $this ->input -> post('endDate');
    	echo "$report"."<br/>";
        echo "$startDate"."<br/>";
        echo "$endDate"."<br/>";
    }
}