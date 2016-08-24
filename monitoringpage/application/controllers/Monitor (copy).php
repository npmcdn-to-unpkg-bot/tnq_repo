<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends CI_Controller {

	  function __construct()  
      {  
         parent::__construct();  
         $this->load->database();
         $this->load->model('MonitoringPage_model');
      }  
      public function index()
      {
         // print_r( $data['author'] = $this->LiveDbtolocal_model->getAuthorDetailsfromdb());
         // echo "<pre>";
         // print_r($this->LiveDbtolocal_model->insertauthor_to_localdb());
         // print_r($this->LiveDbtolocal_model->inserteditor_to_localdb());
         // print_r($this->LiveDbtolocal_model->insertmastercopier_to_localdb());
         // echo "</pre>";
         
         $data['author'] = $this->MonitoringPage_model->getAuthorDetailsfromlocadb();
         $data['editor'] = $this->MonitoringPage_model->getEditorDetailsfromlocaldb();
         $data['mastercopier'] = $this->MonitoringPage_model->getMastercopierDetailsfromlocaldb();
         $this->load->view('monitoringPage_view',$data);
      }


      // public function anotherdb() {
      //    $answer = $this->LiveDbtolocal_model->insert_to_localdb();
      //    return $answer;
      // }
      
      // public function livedbtolocal_control () {
      //    $data['author'] = $this->LiveDbtolocal_model->getAuthorDetailsfromdb();
      //    $data['editor'] = $this->LiveDbtolocal_model->getEditorDetailsfromdb();
      //    $data['mastercopier'] = $this->LiveDbtolocal_model->getMastercopierDetailsfromdb();
      //    $data1 = $this->LiveDbtolocal_model->insert_to_localdb($data);
      //    // print_r($data);
      //    return "$data1";
      // }
}