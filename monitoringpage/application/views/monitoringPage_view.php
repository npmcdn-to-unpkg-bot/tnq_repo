<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Page</title>
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet">
     <link href="<?php echo base_url();?>assets/img/logo.png" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>
<h1 class="text-center">ProofCentral OutWorkflow Monitoring Page</h1>
<div class="container">
    <div class="row">
            <hr/>
            <img src="<?php echo base_url(); ?>assets/img/product-logo.png" width = "200px" height = "75px">
            <hr/>
    </div>
</div>
<div class="container">
<div id="clockbox"></div>
<div class="container">
            <nav class="navbar navbar-default ">
                <div class="container">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="navbar-collapse collapse">
                        <ul class="nav nav-justified">
                            <li><a data-scroll href="#author">Author</a></li>
                            <li><a data-scroll href="#editor">Editor</a></li>
                            <li><a data-scroll href="#mastercopier">Master Copier</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
</div>

<!-- <div id="content">
        <div class="movingfloatobject">
            <div id="placeholder" class="movingfloatobject-holder"></div>
        </div>
</div> -->

<?php foreach ($author as $obj) { 
  if ($obj->OverallTimeTaken > 600) {?>
<div class="alert alert-danger">
  <strong>ALERT FROM OUTWORKFLOW MONITORING PAGE!</strong> </br>
  <strong>Author Stage</strong></br>
  <?php 
  echo $obj->JID;
  echo"-";
  echo $obj->AID;?>
</div>
<?php
  }}
    ?>

<?php foreach ($editor as $obj1) { 
  if ($obj1->OverallTimeTaken > 600) {?>
<div class="alert alert-danger">
  <strong>ALERT FROM OUTWORKFLOW MONITORING PAGE!</strong> </br>
  <strong>Editor Stage</strong></br>
  <?php 
  echo $obj1->JID;
  echo"-";
  echo $obj1->AID;?>
</div>
<?php
  }}
    ?>

<?php foreach ($mastercopier as $obj2) { 
  if ($obj2->OverallTimeTaken > 600) {?>
<div class="alert alert-danger">
  <strong>ALERT FROM OUTWORKFLOW MONITORING PAGE!</strong> </br>
  <strong>Mastor Copier Stage</strong></br>
  <?php 
  echo $obj2->JID;
  echo"-";
  echo $obj2->AID;?>
</div>
<?php
  }}
    ?>    

<section id="author" class = "author">
<div class="container">
    <h2 class="text-center">Author</h2>
    <?php foreach ($author as $obj) { ?>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $obj->JID."-".$obj->AID;?>">
            <?php echo $obj->JID."-".$obj->AID."&nbsp;&nbsp;&nbsp;&nbsp;";if ($obj->OverallTimeTaken > 600) { ?>
                <button type="button" class="btn btn-danger">Time Exceed</button> <?php
            }?>
            </a><!-- <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i> -->
            </h4>
            </div>
            <div id="collapse<?php echo $obj->JID."-".$obj->AID;?>" class="panel-collapse collapse">
                <div class="panel-body">
                <?php echo "JID - "."$obj->JID"."<br/>"?>
                <?php echo "AID - "."$obj->AID"."<br/>"?>
                <?php echo "ArticleKey - "."$obj->ArticleKey"."<br/>"?>
                <?php echo "Article Generated ON - "."$obj->DateArticlePosted"."<br/>"?>
                <?php echo "DatasetID - "."$obj->DataSetID"."<br/>"?>
                <?php echo "IsOffline - "."$obj->IsOffline"."<br/>"?>
                <?php echo "AuthorSubmitted ON - "."$obj->AU_SubmittedDate"."<br/>"?>
                <?php echo "Stage - "."$obj->AU_Stage"."<br/>"?>
              <!--   <table class="table table-hover">
                    <?php
                     $process = [];
                     $process = $obj->AU_Process;
                     $process_edited = explode(",", $process);
                       echo "<tr>";
                       foreach ($process_edited as $newobj) {
                           echo "<th>$newobj</th>";
                       }
                       echo "</tr>";
                    ?>
                    <?php
                      $starttime = [];
                     $starttime = $obj->AU_StartTime;
                     $starttime_edited = explode(",", $starttime);
                     echo "<tr>";
                       foreach ($starttime_edited as $newstart) {
                           echo "<td>$newstart</td>";
                       }
                       echo "</tr>";
                       ?>
                       <?php
                       $endtime = [];
                     $endtime = $obj->AU_EndTime;
                     $endtime_edited = explode(",", $endtime);
                     echo "<tr>";
                       foreach ($endtime_edited as $newend) {
                        echo "<td>$newend</td>";
                       }
                       echo "</tr>";
                       ?>
                       <?php
                       $timetaken = [];
                     $timetaken = $obj->TimeTaken;
                     $timetaken_edited = explode(",", $timetaken);
                     echo "<tr>";
                       foreach ($timetaken_edited as $newtimetaken) {
                           echo "<td><center>$newtimetaken</center></td>";
                       }
                       echo "</tr>";
                       ?>
                </table> -->
                <?php echo "OverAllTimeTaken - "."$obj->OverallTimeTaken"." Secs"."<br/>" ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    } ?>
</div>
</section>

<section id="editor" class = "editor">
<div class="container">
<br/>
    <h2 class="text-center">Editor</h2>
    <?php foreach ($editor as $obj1) { ?>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo "ed".$obj1->JID."-".$obj1->AID;?>">
            <?php echo $obj1->JID."-".$obj1->AID."&nbsp;&nbsp;&nbsp;&nbsp;";if ($obj1->OverallTimeTaken > 600) { ?>
                <button type="button" class="btn btn-danger">Time Exceed</button> <?php
            }?>
            </a><!-- <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i> -->
            </h4>
            </div>
            <div id="collapse<?php echo "ed".$obj1->JID."-".$obj1->AID;?>" class="panel-collapse collapse">
                <div class="panel-body">
                <?php echo "JID - "."$obj1->JID"."<br/>"?>
                <?php echo "AID - "."$obj1->AID"."<br/>"?>
                <?php echo "ArticleKey - "."$obj1->ArticleKey"."<br/>"?>
                <?php echo "Article Generated ON - "."$obj1->DateArticlePosted"."<br/>"?>
                <?php echo "DatasetID - "."$obj1->DataSetID"."<br/>"?>
                <?php echo "IsOffline - "."$obj1->IsOffline"."<br/>"?>
                <?php echo "Editor Submitted ON - "."$obj1->ED_SubmittedDate"."<br/>"?>
                <?php echo "Stage - "."$obj1->ED_Stage"."<br/>"?>
<!--                 <table class="table table-hover">
                    <?php
                     $process = [];
                     $process = $obj1->ED_Process;
                     $process_edited = explode(",", $process);
                       echo "<tr>";
                       foreach ($process_edited as $newobj) {
                           echo "<th>$newobj</th>";
                       }
                       echo "</tr>";
                    ?>
                    <?php
                      $starttime = [];
                     $starttime = $obj1->ED_StartTime;
                     $starttime_edited = explode(",", $starttime);
                     echo "<tr>";
                       foreach ($starttime_edited as $newstart) {
                           echo "<td>$newstart</td>";
                       }
                       echo "</tr>";
                       ?>
                       <?php
                       $endtime = [];
                     $endtime = $obj1->ED_EndTime;
                     $endtime_edited = explode(",", $endtime);
                     echo "<tr>";
                       foreach ($endtime_edited as $newend) {
                        echo "<td>$newend</td>";
                       }
                       echo "</tr>";
                       ?>
                       <?php
                       $timetaken = [];
                     $timetaken = $obj1->TimeTaken;
                     $timetaken_edited = explode(",", $timetaken);
                     echo "<tr>";
                       foreach ($timetaken_edited as $newtimetaken) {
                           echo "<td><center>$newtimetaken</center></td>";
                       }
                       echo "</tr>";
                       ?>
                </table> -->
                <?php echo "OverAllTimeTaken - "."$obj->OverallTimeTaken"." Secs"."<br/>"?>
                </div>
            </div>
        </div>
    </div>

    <?php
    } ?>
</div>
</section>

<section id="mastercopier" class = "mastercopier">
<div class="container">
<br/>
    <h2 class="text-center">Master Copier</h2>
    <?php foreach ($mastercopier as $obj2) { ?>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo "mc".$obj2->JID."-".$obj2->AID;?>">
            <?php echo $obj2->JID."-".$obj2->AID."&nbsp;&nbsp;&nbsp;&nbsp;"; if ($obj2->OverallTimeTaken > 600) { ?>
                <button type="button" class="btn btn-danger">Time Exceed</button> <?php
            }?>
            </a><!-- <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i> -->
            </h4>
            </div>
            <div id="collapse<?php echo "mc".$obj2->JID."-".$obj2->AID;?>" class="panel-collapse collapse">
                <div class="panel-body">
                <?php echo "JID - "."$obj2->JID"."<br/>"?>
                <?php echo "AID - "."$obj2->AID"."<br/>"?>
                <?php echo "ArticleKey - "."$obj2->ArticleKey"."<br/>"?>
                <?php echo "Article Generated ON - "."$obj2->DateArticlePosted"."<br/>"?>
                <?php echo "DatasetID - "."$obj2->DataSetID"."<br/>"?>
                <?php echo "IsOffline - "."$obj2->IsOffline"."<br/>"?>
                <?php echo "Master Copier Submitted ON - "."$obj2->MC_SubmittedDate"."<br/>"?>
                <?php echo "Stage - "."$obj2->MC_Stage"."<br/>"?>
<!--                 <table class="table table-hover">
                    <?php
                     $process = [];
                     $process = $obj2->MC_Process;
                     $process_edited = explode(",", $process);
                       echo "<tr>";
                       foreach ($process_edited as $newobj) {
                           echo "<th>$newobj</th>";
                       }
                       echo "</tr>";

                      $starttime = [];
                     $starttime = $obj2->MC_StartTime;
                     $starttime_edited = explode(",", $starttime);
                     echo "<tr>";
                       foreach ($starttime_edited as $newstart) {
                           echo "<td>$newstart</td>";
                       }
                       echo "</tr>";

                       $endtime = [];
                     $endtime = $obj2->MC_EndTime;
                     $endtime_edited = explode(",", $endtime);
                     echo "<tr>";
                       foreach ($endtime_edited as $newend) {
                        echo "<td>$newend</td>";
                       }
                       echo "</tr>";
                       $timetaken = [];
                     $timetaken = $obj2->TimeTaken;
                     $timetaken_edited = explode(",", $timetaken);
                     echo "<tr>";
                       foreach ($timetaken_edited as $newtimetaken) {
                           echo "<td><center>$newtimetaken</center></td>";
                       }
                       echo "</tr>";
                       ?>
                </table> -->
                <?php echo "OverAllTimeTaken - "."$obj2->OverallTimeTaken"." Secs"."<br/>"?>       
                </div>
                <div>
            </div>
            </div>
        </div>
    </div>
    <?php
    } ?>
</div>
</section>
</div>


    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/main.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
     <script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <!-- // <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>  -->
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!-- Latest compiled and minified JavaScript --> 
<!-- <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>  -->
</body>
</html>