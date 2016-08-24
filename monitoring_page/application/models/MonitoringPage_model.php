<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class MonitoringPage_model extends CI_Model {

    public function __construct() {
     parent::__construct();
     }

     public function pcjournals_model() {
     	$rmqfilename = "/home/raja/RAJA/git/monitoring_page/application/json/rmq-pcjournals.json";
    	$data['rmqmoditime'] = date("F d Y H:i:s", filemtime($rmqfilename));
    	$data['rmqjson'] = json_decode(file_get_contents("$rmqfilename"), true);
    	return $data;
     }
}