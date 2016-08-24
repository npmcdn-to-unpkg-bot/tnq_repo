<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
class PgcdailyReport_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function NumberofArticlesgenerated() {
                $query = $this->db->query("SELECT COUNT(*) AS COUNT FROM pc.Article A WHERE A.JournalKey NOT IN (4001,4000,4002,1638)");
    return $query->result();
    }
	
	public function getAuthorSubmitCount() {
                $query = $this->db->query("SELECT COUNT(*) AS COUNT FROM pc.Article A
                         JOIN pc.ProofRouterHistory P ON P.ArticleKey = A.ArticleKey
                        WHERE A.JournalKey NOT IN (4001,4000,4002,1638)  
                        AND A.StatusID > 2 AND A.StatusID <=7");

                return $query->result();
            }
    public function getAuthorSubmitOnlineCount() {
                $query = $this->db->query("SELECT COUNT(*) AS COUNT FROM pc.Article A
                                 JOIN pc.ProofRouterHistory P ON P.ArticleKey = A.ArticleKey
                                WHERE A.JournalKey NOT IN (4001,4000,4002,1638)  
                                AND A.StatusID > 2 AND A.StatusID <=7 AND
                                P.ProofingMode ='Online'");
                return $query->result();
            }
    public function getAuthorSubmitOfflineCount() {
                $query = $this->db->query("SELECT COUNT(*) AS COUNT  FROM pc.Article A
                                         JOIN pc.ProofRouterHistory P 
                                        ON P.ArticleKey = A.ArticleKey
                                        WHERE A.JournalKey NOT IN (4001,4000,4002,1638)  
                                        AND A.StatusID > 2 AND A.StatusID <= 7 AND (P.ProofingMode ='Offline' OR A.offlineStatus = 1)");
			return $query->result();
            }

}

