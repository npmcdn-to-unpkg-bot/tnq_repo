<?php  
   class MonitoringPage_model extends CI_Model  
   {
      function __construct()  
      {
         parent::__construct();
         $this->load->database();
         $this->localdb = $this->load->database('localdb', TRUE);
      }
     public function getAuthorDetailsfromlocaldb() {
         $query = $this->localdb->query("SELECT * FROM Author WHERE DATE_TIME BETWEEN NOW() - INTERVAL 15 MINUTE  AND NOW()");
         return $query->result();      
      }
      public function getEditorDetailsfromlocaldb() {
        $query = $this->localdb->query("SELECT * FROM Editor WHERE DATE_TIME BETWEEN NOW() - INTERVAL 15 MINUTE  AND NOW()");
        return $query->result();    
      }
      public function getMastercopierDetailsfromlocaldb() {
        $query = $this->localdb->query("SELECT * FROM MastorCopier WHERE DATE_TIME BETWEEN NOW() - INTERVAL 15 MINUTE  AND NOW()");
        return $query->result(); 
      }


 }