<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livedbtolocaldb extends CI_Controller {
	public function __construct()
	 {  
         parent::__construct();  
         $this->load->database();
         $this->load->model('LiveDbtolocal_model');
      }
      public function index()
      {
      	$this->LiveDbtolocal_model->insertauthor_to_localdb();
      	$this->LiveDbtolocal_model->inserteditor_to_localdb();
      	$this->LiveDbtolocal_model->insertmastercopier_to_localdb();
      }

      public function test() {
      	echo 'test';
      }
}