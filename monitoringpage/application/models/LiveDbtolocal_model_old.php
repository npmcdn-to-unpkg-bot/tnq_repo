<?php

   defined('BASEPATH') OR exit('No direct script access allowed');

   class LiveDbtolocal_model extends CI_Model {

        public function __construct() {
         parent::__construct();
         $this->localdb = $this->load->database('localdb', TRUE);
         }

      public function getAuthorDetailsfromdb() {

         $query = $this->db->query("SELECT
                      DISTINCT S.SupplierName AS SupplierName,
                      A.StatusID,
                      A.ArticleKey,
                      J.JID AS JID,
                      A.AID AS AID,
                      A.DateArticlePosted,
                      D.DataSetID,
                      A.OfflineStatus AS IsOffline,
                      IF (pcsau.status='completed', pcsau.updated_at, '-') AS AU_SubmittedDate,
                      outau.stage AS AU_Stage,
                      GROUP_CONCAT(DISTINCT outau.process) AS AU_Process,
                      GROUP_CONCAT(DISTINCT outau.start_time) AS AU_StartTime,
                      GROUP_CONCAT(DISTINCT outau.end_time) AS AU_EndTime,
                      GROUP_CONCAT(DISTINCT TIMESTAMPDIFF(SECOND,outau.start_time, outau.end_time)) AS TimeTaken,
                      TIMESTAMPDIFF(MINUTE ,pcsau.updated_at,(SELECT MAX(outau.end_time))) AS OverallTimeTaken
                  FROM 
                      pc_pe.Article A
                      INNER JOIN pc_pe.Journals J ON J.JournalKey = A.JournalKey
                      INNER JOIN pc_pe.chain_workflow C ON C.article_key = A.ArticleKey
                      INNER JOIN pc_pe.out_workflow OW ON OW.article_key = A.ArticleKey
                      INNER JOIN pc_pe_chain.workflow pcw ON pcw.uuid = C.uuid
                      INNER JOIN pc_pe.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                      INNER JOIN pc_pe.Supplier S ON S.SupplierID = D.SupplierID
                      INNER JOIN pc_pe.out_workflow outau ON outau.article_key = A.ArticleKey AND outau.stage = 'author'
                      INNER JOIN pc_pe_chain.stage pcsau ON pcsau.workflow_id = pcw.id AND pcsau.name = 'AU' 
                  WHERE
                  pcsau.updated_at BETWEEN NOW() - INTERVAL 5 DAY  AND NOW()
                  AND A.StatusID < 8
                  AND S.SupplierName NOT IN ('PCDEVTEST')
                  GROUP BY J.JID, A.AID
                  LIMIT 300");
                  return $query->result();      
        }

        public function getEditorDetailsfromdb() {

         $query = $this->db->query("SELECT
                      DISTINCT S.SupplierName AS SupplierName,
                      A.StatusID,
                      A.ArticleKey,
                      J.JID AS JID,
                      A.AID AS AID,
                      A.DateArticlePosted,
                      D.DataSetID,
                      A.OfflineStatus AS IsOffline,
                      IF (pcsed.status='completed', pcsed.updated_at, '-') AS ED_SubmittedDate,
                      outed.stage AS ED_Stage,
                      GROUP_CONCAT(DISTINCT outed.process) AS ED_Process,
                      GROUP_CONCAT(DISTINCT outed.start_time) AS ED_StartTime,
                      GROUP_CONCAT(DISTINCT outed.end_time) AS ED_EndTime,
                      GROUP_CONCAT(DISTINCT TIMESTAMPDIFF(SECOND,outed.start_time, outed.end_time)) AS TimeTaken,
                      TIMESTAMPDIFF(MINUTE ,pcsed.updated_at,(SELECT MAX(outed.end_time))) AS OverallTimeTaken
                  FROM 
                      pc_pe.Article A
                      INNER JOIN pc_pe.Journals J ON J.JournalKey = A.JournalKey
                      INNER JOIN pc_pe.chain_workflow C ON C.article_key = A.ArticleKey
                      INNER JOIN pc_pe.out_workflow OW ON OW.article_key = A.ArticleKey
                      INNER JOIN pc_pe_chain.workflow pcw ON pcw.uuid = C.uuid
                      INNER JOIN pc_pe.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                      INNER JOIN pc_pe.Supplier S ON S.SupplierID = D.SupplierID
                      INNER JOIN pc_pe.out_workflow outed ON outed.article_key = A.ArticleKey AND outed.stage = 'editor'
                      INNER JOIN pc_pe_chain.stage pcsed ON pcsed.workflow_id = pcw.id AND pcsed.name = 'ED' 
                  WHERE
                  pcsed.updated_at BETWEEN NOW() - INTERVAL 1 MONTH  AND NOW()
                  AND A.StatusID < 8
                  AND S.SupplierName NOT IN ('PCDEVTEST')
                  GROUP BY J.JID, A.AID
                  LIMIT 300");
                  return $query->result();      
        }

         public function getMastercopierDetailsfromdb()  {

         $query = $this->db->query("SELECT
                      DISTINCT S.SupplierName AS SupplierName,
                      A.StatusID,
                      A.ArticleKey,
                      J.JID AS JID,
                      A.AID AS AID,
                      A.DateArticlePosted,
                      D.DataSetID,
                      A.OfflineStatus AS IsOffline,
                      IF (pcsmc.status='completed', pcsmc.updated_at, '-') AS MC_SubmittedDate,
                      outmc.stage AS MC_Stage,
                      GROUP_CONCAT(DISTINCT outmc.process) AS MC_Process,
                      GROUP_CONCAT(DISTINCT outmc.start_time) AS MC_StartTime,
                      GROUP_CONCAT(DISTINCT outmc.end_time) AS MC_EndTime,
                      GROUP_CONCAT(DISTINCT TIMESTAMPDIFF(SECOND,outmc.start_time, outmc.end_time)) AS TimeTaken,
                      TIMESTAMPDIFF(MINUTE ,pcsmc.updated_at,(SELECT MAX(outmc.end_time))) AS OverallTimeTaken
                  FROM 
                      pc_pe.Article A
                      INNER JOIN pc_pe.Journals J ON J.JournalKey = A.JournalKey
                      INNER JOIN pc_pe.chain_workflow C ON C.article_key = A.ArticleKey
                      INNER JOIN pc_pe.out_workflow OW ON OW.article_key = A.ArticleKey
                      INNER JOIN pc_pe_chain.workflow pcw ON pcw.uuid = C.uuid
                      INNER JOIN pc_pe.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                      INNER JOIN pc_pe.Supplier S ON S.SupplierID = D.SupplierID
                      INNER JOIN pc_pe.out_workflow outmc ON outmc.article_key = A.ArticleKey AND outmc.stage = 'master copier'
                      INNER JOIN pc_pe_chain.stage pcsmc ON pcsmc.workflow_id = pcw.id AND pcsmc.name = 'MC' 
                  WHERE
                  pcsmc.updated_at BETWEEN NOW() - INTERVAL 1 MONTH  AND NOW()
                  AND A.StatusID < 8
                  AND S.SupplierName NOT IN ('PCDEVTEST')
                  GROUP BY J.JID, A.AID
                  LIMIT 300");
                  return $query->result();

            }
            // public function getanotherdb() {
            // $localdb= $this->load->database('localdb', TRUE);
            // // print_r($localdb);
            // $query = $query = $localdb->query("SELECT * FROM workflow");
            // return $query->result();
            // }
            public function insert_to_localdb($data) {
                $suppliername = $data['SupplierName'];
                return $suppliername;
            }
   }

      

