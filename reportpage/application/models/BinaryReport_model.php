<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BinaryReport_model extends CI_Model {

	function __construct() {  
        parent::__construct();
    }

    public function getbinaryreportfromdb($request)
    {
        $sql = "SELECT
                	T1.SupplierName,
                	T1.Articles_Generated,
                	T2.Total_Queries,
                	T3.Binary_Queries,
                	(T2.Total_Queries - T3.Binary_Queries) AS NonBinaryQueries,
                	((T3.Binary_Queries / (T2.Total_Queries - T3.Binary_Queries)) * 100) AS Percentage_Of_Binary_Queries,
                	CONCAT('http://live.elsevierproofcentral.com/authorproofs/',T3.token)AS URL
                FROM
                	(SELECT
                	S.SupplierName,
                    count(A.ArticleKey) AS Articles_Generated
                FROM
                    pc.Article A
                    JOIN pc.Journals J ON J.JournalKey = A.JournalKey
                    JOIN pc.ProofRouterHistory P ON P.ArticleKey = A.ArticleKey
                    JOIN pc.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                    JOIN pc.Supplier S ON S.SupplierId = D.SupplierId
                    JOIN pc.chain_workflow C ON C.article_key = A.ArticleKey
                WHERE
                    Date(A.DateArticlePosted) Between '$startDate' AND '$endDate'    
                    AND S.SupplierName IN ('TNQ', 'SPS', 'VTEX', 'THOM', 'SPIN2', 'MACM', 'BESTS', 'FOCAL', 'KOL', 'APTAR')
                    GROUP BY S.SupplierName) AS T1

                LEFT OUTER JOIN (SELECT
                	S.SupplierName,
                    count(AQ.article_key) AS Total_Queries
                FROM
                    pc.Article A
                    JOIN pc.Journals J ON J.JournalKey = A.JournalKey
                    JOIN pc.ProofRouterHistory P ON P.ArticleKey = A.ArticleKey
                    JOIN pc.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                    JOIN pc.Supplier S ON S.SupplierId = D.SupplierId
                    JOIN pc.chain_workflow C ON C.article_key = A.ArticleKey
                	JOIN pc.AuthorQuery AQ ON AQ.article_key = A.ArticleKey
                WHERE
                    Date(A.DateArticlePosted) Between '$startDate' AND '$endDate'    
                    AND S.SupplierName IN ('TNQ', 'SPS', 'VTEX', 'THOM', 'SPIN2', 'MACM', 'BESTS', 'FOCAL', 'KOL', 'APTAR')
                    GROUP BY S.SupplierName) AS T2 ON T1.SupplierName = T2.SupplierName
                LEFT OUTER JOIN (SELECT
                	S.SupplierName,
                    count(AQ.article_key) AS Binary_Queries,
                    U.token
                FROM
                    pc.Article A
                    JOIN pc.Journals J ON J.JournalKey = A.JournalKey
                    JOIN pc.ProofRouterHistory P ON P.ArticleKey = A.ArticleKey
                    JOIN pc.DatasetStatus D ON D.DatasetStatusID = A.DatasetStatusID
                    JOIN pc.Supplier S ON S.SupplierId = D.SupplierId
                    JOIN pc.chain_workflow C ON C.article_key = A.ArticleKey
                	JOIN pc.AuthorQuery AQ ON AQ.article_key = A.ArticleKey
                	JOIN pc.users U ON U.optarticleid = A.ArticleKey
                WHERE
                    Date(A.DateArticlePosted) Between '$startDate' AND '$endDate'    
                    AND S.SupplierName IN ('TNQ', 'SPS', 'VTEX', 'THOM', 'SPIN2', 'MACM', 'BESTS', 'FOCAL', 'KOL', 'APTAR')
                    AND AQ.type='boolean'
                    GROUP BY S.SupplierName) AS T3 ON T3.SupplierName = T2.SupplierName
                	Limit 0,30";

                 try{
                $result  = $this->db->query($sql);
               if($sql_result->num_rows > 0){
                    foreach ($sql_result->result_array() as $details){
                      
                    }
                }else{
                        throw new Exception("No Records Found", 1);
                 }
            }catch(Exception $e){
                    print json_encode($this->report);
                    die;
            }


            // return $query->result();
         // print json_encode($binaryreport);
    }