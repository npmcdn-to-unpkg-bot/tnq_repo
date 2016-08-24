<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PgcdailyReport extends CI_Controller {

	function __construct() {  
        parent::__construct();
        $this->load->model('PgcdailyReport_model');
        $this->load->library('email');
    }  

    public function index() {
        $this->load->view('reportPage_view');
    }

    public function dataCollect() {
	    $data['NumberofArticlesgenerated'] = $this->PgcdailyReport_model->NumberofArticlesgenerated();
		$data['NumberofArticlesAuthorSubmitted'] = $this->PgcdailyReport_model->getAuthorSubmitCount();
		$data['NumberofArticlesAuthorSubmittedOnline'] = $this->PgcdailyReport_model->getAuthorSubmitOnlineCount();
		$data['NumberofArticlesAuthorSubmittedOffline'] = $this->PgcdailyReport_model->getAuthorSubmitOfflineCount();
        return $data;
    }

    public function email() {
    $today = date("F j, Y");
    $data = $this->dataCollect();
    $NumberofArticlesgenerated = $data['NumberofArticlesgenerated'][0]->COUNT;
    $NumberofArticlesAuthorSubmitted = $data['NumberofArticlesAuthorSubmitted'][0]->COUNT;
    $NumberofArticlesAuthorSubmittedOnline = $data['NumberofArticlesAuthorSubmittedOnline'][0]->COUNT;
    $NumberofArticlesAuthorSubmittedOffline = $data['NumberofArticlesAuthorSubmittedOffline'][0]->COUNT;
    $online_article_uptake = round($NumberofArticlesAuthorSubmittedOnline / $NumberofArticlesgenerated, 2) * 100;
    $subject = sprintf("PGC- status Report - [$today]");
    $heading = "<html><body>Hi Vidhya,<br/><br/>";
    $body1 =   "<table border='1' bordercolor='#95bCE2' cellspacing='0' cellpadding='4' style='border-collapse:collapse;'><tr><td>Articles processed via PC so far</td><td>$NumberofArticlesgenerated</td></tr><tr><td>Articles submitted by author</td><td>$NumberofArticlesAuthorSubmitted</td></tr><tr><td>Articles submitted by author online</td><td>$NumberofArticlesAuthorSubmittedOnline ($online_article_uptake% uptake)</td></tr><tr><td>Articles submitted by author offline</td><td>$NumberofArticlesAuthorSubmittedOffline</td></tr></table><br/>";
    $footer = "<br/>Thanks,<br/>Proof Central Support Team.<br/><br/><br/><b>Note: This is an automated mail. Do not reply to this mail</b></body></html>";
    $message = $heading.$body1.$footer;;
    $body = '<body>'.$message.'</body></html>';
    $result = $this->email
    ->from('pcapptest@tnqsoftware.co.in','Proof Central Support Team')
    ->to(['meenaraja@tnqsoftware.co.in'])
    ->cc(['leoamirtharaj@tnqsoftware.co.in'])
    ->subject($subject)
    ->message($body)
    ->send();
    echo "Mail successfully Sent";
	}

    public function dummytest() {
        $data = $this->dataCollect();
        echo "$data";
    }

}