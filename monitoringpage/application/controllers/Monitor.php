<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends CI_Controller {

	function __construct() {  
        parent::__construct();  
        $this->load->database();
        $this->load->model('MonitoringPage_model');
        $this->load->model('LiveDbtolocal_model');
        $this->load->library('email');
    }  

    public function index() {
        $data['author'] = $this->MonitoringPage_model->getAuthorDetailsfromlocaldb();
        $data['editor'] = $this->MonitoringPage_model->getEditorDetailsfromlocaldb();
        $data['mastercopier'] = $this->MonitoringPage_model->getMastercopierDetailsfromlocaldb();
        $this->load->view('monitoringPage_view',$data);
    }

    public function loadLocalDB() {
        $this->LiveDbtolocal_model->insertauthor_to_localdb();
        $this->LiveDbtolocal_model->inserteditor_to_localdb();
        $this->LiveDbtolocal_model->insertmastercopier_to_localdb();
    }

    public function sendingmail() {
        $author = $this->MonitoringPage_model->getAuthorDetailsfromlocaldb();
        $editor = $this->MonitoringPage_model->getEditorDetailsfromlocaldb();
        $mastercopier = $this->MonitoringPage_model->getMastercopierDetailsfromlocaldb();

        foreach ($author as $obj) {
            if( $obj->OverallTimeTaken > 600 ) {
                $timetaken = $obj->OverallTimeTaken;
                $jid = $obj->JID;
                $aid = $obj->AID;
                $this->email('Author',$timetaken,$jid,$aid);
            }
        }

        foreach ($editor as $obj1) {
            if( $obj1->OverallTimeTaken > 600 ) {
                $timetaken = $obj1->OverallTimeTaken;
                $jid = $obj1->JID;
                $aid = $obj1->AID;
                $this->email('Editor',$timetaken,$jid,$aid);
            }
        }

        foreach ($mastercopier as $obj2) {
            if( $obj2->OverallTimeTaken > 600 ) {
                $timetaken = $obj2->OverallTimeTaken;
                $jid = $obj2->JID;
                $aid = $obj2->AID;
                $this->email('Mastercopier',$timetaken,$jid,$aid);
            }
        }
    }

    public function email($msg,$timetaken,$jid,$aid) {
        $subject = sprintf("ALERT FROM OUTWORKFLOW MONITORING PAGE-(%s-%s)-%s", $jid, $aid, $msg);
        $heading = "<html><body>Hi All,<br/><br/>";
        $body1 =   "For the Article $jid-$aid takes more than 10 Mins<br/><br/> It Takes $timetaken Secs.<br/><br/>";
        $footer = "</table><br/>Thanks,<br/>Proof Central Support Team.<br/><br/><strong>This is an automated Email.</strong></body></html>";
        $message = $heading.$body1.$footer;;
        $body = '<body>
                '.$message.'
                </body>
                </html>';

        $result = $this->email
        ->from('pcapptest@tnqsoftware.co.in','Proof Central Support Team')
        // ->reply_to('nithya.sadasivam@tnqsoftware.co.in')    // Optional, an account where a human being reads.
        ->to(['meenaraja@tnqsoftware.co.in','leoamirtharaj@tnqsoftware.co.in'])
        ->cc(['leoamirtharaj@tnqsoftware.co.in'])
        ->subject($subject)
        ->message($body)
        ->send();
            // Also, for getting full html you may use the following internal method:
            //$body = $this->email->full_html($subject, $message);

    } 
}