<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Report Page</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
    <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet">
     <link href="<?php echo base_url();?>assets/img/logo.png" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>
<h1 class="text-center">ProofCentral Report Page</h1>
<div class="container">
    <div class="row">
            <hr/>
            <img src="<?php echo base_url(); ?>assets/img/product-logo.png" width = "200px" height = "75px">
            <hr/>
    </div>
</div>

<div class="container">
    <div class="row text-center"><div class="text-center"><h1 class="text-center">...</h1></div>
        <label>Reports : </label>
        <select id="report-type" name="reporttype" class="tb">
            <option value="selectreporttype">Select Report Type</option>
            <option value="binaryreport">Binary Report</option>
            <option value="cerejectionreport">CE Rejection Report</option>
            <option value="archivalreport">Archival Report</option>
        </select>
            <label for="startDate">StartDate</label>
            <input type="text" id="datepicker" class="tb" name = "startDate" >
            <label for="startDate">EndDate</label>
            <input type="text" id="datepicker1" class="tb" name = "endDate">
            <input type="submit" name="show" value="Show" id="show" class="tb" />
    </div>

    <div class="container">
    <div class="row text-center">
        <div id="loadingImge"><img src="<?php echo base_url();?>assets/img/loadingimage4.gif" width = "100px" height = "100px"></div>
    </div>
</div>
    <div id="BinaryReport">
        <table class="table table-hover">
        <thead>
            <tr>
                <th>SupplierName</th>
                <th>Articles_Generated</th>
                <th>Total_Queries</th>
                <th>Binary_Queries</th>
                <th>NonBinaryQueries</th>
                <th>Percentage_Of_Binary_Queries</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody id = "tableforbinaryreport">
            
        </tbody>
    </table>
    </div>
</div>

    <!-- js -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/js/reportpage.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</body>
</html>