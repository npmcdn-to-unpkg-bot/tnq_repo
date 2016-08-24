<!DOCTYPE html>
<html>
<head>
    <title>PGC Daily Mail Report Page</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
    <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet">
     <link href="<?php echo base_url();?>assets/img/logo.png" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>
<h1 class="text-center">PGC Daily Mail Report Page</h1>
<div class="container">
    <div class="row">
            <hr/>
            <img src="<?php echo base_url(); ?>assets/img/pagecentral.png" width = "200px" height = "75px">
            <hr/>
    </div>
</div>

<div class="container">
    <div class="row text-center"><div class="text-center"><h1 class="text-center">...</h1></div>
        <!-- <button type="submit" name="show" id = "" class="btn btn-primary">Primary</button> -->
        <input type="submit" name="show" value="Sent Mail" id="show" class="btn btn-primary" />
    </div>
</div>
<div class="container">
    <div class="row text-center">
        <div id="loadingImge"><img src="<?php echo base_url();?>assets/img/loadingimage4.gif" width = "100px" height = "100px"></div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/reportpage.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>