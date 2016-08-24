<?php

   defined('BASEPATH') OR exit('No direct script access allowed');

   class LiveDbtolocal_model extends CI_Model {

        public function __construct() {
         parent::__construct();
         $this->default = $this->load->database('default',TRUE);
         $this->localdb = $this->load->database('localdb', TRUE);
         }

        public function getAuthorDetailsfromdb() {

         $query = $this->default->query("SELECT
                          S.SupplierName AS SupplierName,
                          A.StatusID,
                          A.ArticleKey,
                          J.JID AS JID,
                          A.AID AS AID,
                          A.DateArticlePosted,
                          D.DataSetID,
                          A.OfflineStatus AS IsOffline,
                          IF (pcsau.status='completed', pcsau.updated_at, '-') AS AU_SubmittedDate,
                          outau.stage AS AU_Stage,
                          GROUP_CONCAT(outau.process) AS AU_Process,
                          GROUP_CONCAT(outau.start_time) AS AU_StartTime,
                          GROUP_CONCAT(outau.end_time) AS AU_EndTime,
                          GROUP_CONCAT(TIMESTAMPDIFF(SECOND,outau.start_time, outau.end_time))AS TimeTaken,
                          TIMESTAMPDIFF(SECOND ,pcsau.updated_at,(SELECT MAX(outau.end_time))) AS OverallTimeTaken
                      FROM 
                          opt.out_workflow outau
                      INNER JOIN Article A ON A.ArticleKey = outau.article_key
                      INNER JOIN opt.chain_workflow C ON C.article_key = A.ArticleKey
                      INNER JOIN opt.Journals J ON J.JournalKey = A.JournalKey
                      INNER JOIN pc_chain.workflow pcw ON pcw.uuid = C.uuid
                      INNER JOIN pc_chain.stage pcsau ON pcsau.workflow_id = pcw.id AND pcsau.name = 'AU'
                      INNER JOIN opt.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                      INNER JOIN opt.Supplier S ON S.SupplierID = D.SupplierID
                      WHERE
                      pcsau.updated_at BETWEEN NOW() - INTERVAL 15 MINUTE  AND NOW()
                      AND A.StatusID < 7
                      AND S.SupplierName NOT IN ('PCDEVTEST')
                      AND outau.stage = 'author'
                      GROUP BY outau.stage,outau.article_key
                      LIMIT 300");
                  return $query->result();      
        }

        public function getEditorDetailsfromdb() {

         $query = $this->default->query("SELECT
                          S.SupplierName AS SupplierName,
                          A.StatusID,
                          A.ArticleKey,
                          J.JID AS JID,
                          A.AID AS AID,
                          A.DateArticlePosted,
                          D.DataSetID,
                          A.OfflineStatus AS IsOffline,
                          IF (pcsed.status='completed', pcsed.updated_at, '-') AS ED_SubmittedDate,
                          outed.stage AS ED_Stage,
                          GROUP_CONCAT(outed.process) AS ED_Process,
                          GROUP_CONCAT(outed.start_time) AS ED_StartTime,
                          GROUP_CONCAT(outed.end_time) AS ED_EndTime,
                          GROUP_CONCAT(TIMESTAMPDIFF(SECOND,outed.start_time, outed.end_time))AS TimeTaken,
                          TIMESTAMPDIFF(SECOND ,pcsed.updated_at,(SELECT MAX(outed.end_time))) AS OverallTimeTaken
                      FROM 
                          opt.out_workflow outed
                      INNER JOIN Article A ON A.ArticleKey = outed.article_key
                      INNER JOIN opt.chain_workflow C ON C.article_key = A.ArticleKey
                      INNER JOIN opt.Journals J ON J.JournalKey = A.JournalKey
                      INNER JOIN pc_chain.workflow pcw ON pcw.uuid = C.uuid
                      INNER JOIN pc_chain.stage pcsed ON pcsed.workflow_id = pcw.id AND pcsed.name = 'ED'
                      INNER JOIN opt.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                      INNER JOIN opt.Supplier S ON S.SupplierID = D.SupplierID
                      WHERE
                      pcsed.updated_at BETWEEN NOW() - INTERVAL 15 MINUTE  AND NOW()
                      AND A.StatusID < 8
                      AND S.SupplierName NOT IN ('PCDEVTEST')
                      AND outed.stage = 'editor'
                      GROUP BY outed.stage,outed.article_key
                      LIMIT 300");
                  return $query->result();      
        }

         public function getMastercopierDetailsfromdb()  {

         $query = $this->default->query("SELECT
                          S.SupplierName AS SupplierName,
                          A.StatusID,
                          A.ArticleKey,
                          J.JID AS JID,
                          A.AID AS AID,
                          A.DateArticlePosted,
                          D.DataSetID,
                          A.OfflineStatus AS IsOffline,
                          IF (pcsmc.status='completed', pcsmc.updated_at, '-') AS MC_SubmittedDate,
                          outmc.stage AS MC_Stage,
                          GROUP_CONCAT(outmc.process) AS MC_Process,
                          GROUP_CONCAT(outmc.start_time) AS MC_StartTime,
                          GROUP_CONCAT(outmc.end_time) AS MC_EndTime,
                          GROUP_CONCAT(TIMESTAMPDIFF(SECOND,outmc.start_time, outmc.end_time))AS TimeTaken,
                          TIMESTAMPDIFF(SECOND ,pcsmc.updated_at,(SELECT MAX(outmc.end_time))) AS OverallTimeTaken
                      FROM 
                          opt.out_workflow outmc
                      INNER JOIN Article A ON A.ArticleKey = outmc.article_key
                      INNER JOIN opt.chain_workflow C ON C.article_key = A.ArticleKey
                      INNER JOIN opt.Journals J ON J.JournalKey = A.JournalKey
                      INNER JOIN pc_chain.workflow pcw ON pcw.uuid = C.uuid
                      INNER JOIN pc_chain.stage pcsmc ON pcsmc.workflow_id = pcw.id AND pcsmc.name = 'MC'
                      INNER JOIN opt.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                      INNER JOIN opt.Supplier S ON S.SupplierID = D.SupplierID
                      WHERE
                      pcsmc.updated_at BETWEEN NOW() - INTERVAL 15 MINUTE  AND NOW()
                      AND A.StatusID < 8
                      AND S.SupplierName NOT IN ('PCDEVTEST')
                      AND outmc.stage = 'master copier'
                      GROUP BY outmc.stage,outmc.article_key
                      LIMIT 300");
                  return $query->result();

            }
            // public function getanotherdb() {
            // $localdb= $this->load->database('localdb', TRUE);
            // print_r($localdb);
            // $query = $query = $localdb->query("SELECT * FROM workflow");
            // return $query->result();
            // }

            public function insertauthor_to_localdb() {
                $sql = array();
                $result = $this->getAuthorDetailsfromdb();
                $json_string = json_encode($result);
                $json_decode = json_decode($json_string,TRUE);
                foreach ($json_decode as $key => $value) {
                    $fields = $colums = array();
                    foreach ($value as $keys => $values) {
                        $fields[] = $keys;
                        $colums[] = $values;
                    }
                    $fields = implode(',', $fields);
                    $colums = implode('","', $colums);
                 $query = $this->localdb->query('INSERT INTO Author ('.$fields.') VALUES("'.$colums.'")');
                }
            }

            public function inserteditor_to_localdb() {
                $sql = array();
                $result = $this->getEditorDetailsfromdb();
                $json_string = json_encode($result);
                $json_decode = json_decode($json_string,TRUE);
                foreach ($json_decode as $key => $value) {
                    $fields = $colums = array();
                    foreach ($value as $keys => $values) {
                        $fields[] = $keys;
                        $colums[] = $values;
                    }
                    $fields = implode(',', $fields);
                    $colums = implode('","', $colums);
                 $query = $this->localdb->query('INSERT INTO Editor ('.$fields.') VALUES("'.$colums.'")');
                }
            }


            public function insertmastercopier_to_localdb() {
                $sql = array();
                $result = $this->getMastercopierDetailsfromdb();
                $json_string = json_encode($result);
                $json_decode = json_decode($json_string,TRUE);
                foreach ($json_decode as $key => $value) {
                    $fields = $colums = array();
                    foreach ($value as $keys => $values) {
                        $fields[] = $keys;
                        $colums[] = $values;
                    }
                    $fields = implode(',', $fields);
                    $colums = implode('","', $colums);
                 $query = $this->localdb->query('INSERT INTO MastorCopier ('.$fields.') VALUES("'.$colums.'")');
                }
            }



            // public function test() {
            //         $query = $this->default->query("SELECT * FROM users WHERE optarticleid = 759105 LIMIT 1");
            //         return $query->result();
            // }







                // foreach (array_values($result) as $trimedarray) {
                // }
                // $array = json_decode($json_string,TRUE);

                // while ($fullresult = array_shift($fullresult1)) {
                //     foreach ($fullresult as $key => $value) {
                //         return $value;
                //     }
                // }
                // $value = json_decode(json_encode($result), true);
                // echo $value['values']['0']['SupplierName'];

                // foreach($result as $key => $val){
                //    if(is_array($val)){
                //        foreach($val as $subval){
                //            $character[] = $key;
                //            $author_id[] = $subval->SupplierName;
                //            $author_name[] = $subval->ArticleKey;
                //        }
                //    }
                // return $val;
                // }

                // $author = $this->object_2_array($result);



                // // foreach ($author as $key => $value) {
                // //     $auhtorr[] = $value->author;
                // // }

                


                // if(empty($author)) {
                // throw new InvalidArgumentException('Cannot insert an empty array.');
                // }
                // foreach (array_values($author) as $trimedarray) {
                //     $field1 = $trimedarray;
                //     // $fields = '`' . implode('`, `', array_keys($field1)) . '`';
                //     // $placeholders = ':' . implode(', :', array_keys($field1));
                //     // $field1 = '`' . implode('`, `', array_values($key)) . '`';
                //  return $field1;
                // }

                //  $sql = "INSERT INTO {$table} ($fields) VALUES ({$placeholders})";


                // $author = array_filter($author);
                // foreach( array_keys($author) as $key ) {
                //         if( !in_array($key, $exclude) ) {
                //         $fields[] = "`$key`";
                //         $values[] = "'" . mysql_real_escape_string($key1[$key]) . "'";
                //     }
                // }

                //  $fields = implode(",", $fields);
                // $values = implode(",", $values);
                // // print_r($fields);

                // if( $this->localdb->query("INSERT INTO `Author` ($fields) VALUES ($values)") ) {
                // return array( "mysql_error" => false,
                // "mysql_insert_id" => mysql_insert_id(),
                // "mysql_affected_rows" => mysql_affected_rows(),
                // "mysql_info" => mysql_info()
                // );
                // } else {
                // return array( "mysql_error" => mysql_error() );
                // }



            // foreach( array_keys($author) as $key1 ) {
            //         foreach( array_keys($key1) as $key ) {
            //             if( !in_array($key, $exclude) ) {
            //             $fields[] = "`$key`";
            //             $values[] = "'" . mysql_real_escape_string($key1[$key]) . "'";
            //             }
            //         }
            //     }

            //      $fields = implode(",", $fields);
            //     $values = implode(",", $values);
            //     // print_r($fields);

            //     if( $this->localdb->query("INSERT INTO `Author` ($fields) VALUES ($values)") ) {
            //     return array( "mysql_error" => false,
            //     "mysql_insert_id" => mysql_insert_id(),
            //     "mysql_affected_rows" => mysql_affected_rows(),
            //     "mysql_info" => mysql_info()
            //     );
            //     } else {
            //     return array( "mysql_error" => mysql_error() );
            //     }




                // foreach ($author as $obj) {
                // $query = $this->localdb->query("INSERT INTO Author (SupplierName,StatusID,ArticleKey,JID,AID,DateArticlePosted,DatasetID,IsOffline,AU_SubmittedDate,AU_Stage,AU_Process,AU_StartTime,AU_EndTime,TimeTaken,OverallTimeTaken) VALUES ('$obj->SupplierName','$obj->StatusID','$obj->ArticleKey','$obj->JID','$obj->AID','$obj->DateArticlePosted','$obj->DataSetID','$obj->IsOffline','$obj->AU_SubmittedDate','$obj->AU_Stage','$obj->AU_Process','$obj->AU_StartTime','$obj->AU_EndTime','$obj->TimeTaken','$obj->OverallTimeTaken')");
                // }
                // return $query->result();
                    // echo "copied";
                    // return $author;
            
   }

      

