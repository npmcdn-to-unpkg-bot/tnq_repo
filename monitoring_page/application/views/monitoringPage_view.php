<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="30">
    <title>Monitoring Page</title>
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet">
     <link href="<?php echo base_url();?>assets/img/logo.png" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>
<h1 class="text-center">Monitoring Page</h1>
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
                            <li><a data-scroll href="#pcjournals">PC Journals</a></li>
                            <li><a data-scroll href="#pcbooks">PC Books</a></li>
                            <li><a data-scroll href="#pcrsc">PC RSC</a></li>
                            <li><a data-scroll href="#pgcjournals">PGC Journals</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
</div>

<section id="pcjournals" class = "pcjournals">
    <h2 class="text-center text-uppercase">PC Journals</h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
<!--                 <div class="rabbitmq">
                    <div>
                        <i>test</i>
                    </div>
                </div> -->
                <h3 class="text-uppercase text-center">RabbitMQ Status</h3>
                <p class="text-center">test
            <?php print_r($pcjournals); ?></p>
                </div> <!-- col-sm-4-->

                 <div class="col-sm-4">
<!--                 <div class="rabbitmq">
                    <div>
                        <i>test</i>
                    </div>
                </div> -->
                <h3 class="text-uppercase text-center">App Server 01 Status</h3>
                <p class="text-center">test
            <?php print_r($pcjournals); ?></p>
                </div> <!-- col-sm-4-->

                 <div class="col-sm-4">
<!--                 <div class="rabbitmq">
                    <div>
                        <i>test</i>
                    </div>
                </div> -->
                <h3 class="text-uppercase text-center">App Server 02 Status</h3>
                <p class="text-center">test
            <?php print_r($pcjournals); ?></p>
                </div> <!-- col-sm-4-->


            </div> <!--row-->
        </div> <!--container-->
</section> <!--pcjournals section-->

<section id="pcbooks" class = "pcbooks">
  <h2 class="text-center text-uppercase">PC BOOKS</h2>
        <div class="container">
            <div class="row">
            </div> <!--row-->
        </div> <!--container-->
</section> <!--pcbooks section-->

<section id="pcrsc" class = "pcrsc">
  <h2 class="text-center text-uppercase">PC RSC</h2>
        <div class="container">
            <div class="row">
            </div> <!--row-->
        </div> <!--container-->
</section> <!--pcrsc section-->

<section id="pgcjournals" class = "pgcjournals">
  <h2 class="text-center text-uppercase">PGC Journals</h2>
        <div class="container">
            <div class="row">
            </div> <!--row-->
        </div> <!--container-->
</section> <!--pgcjournals section-->

<script src="<?php echo base_url();?>assets/js/jquery-1.12.0.min.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/smooth-scroll.js"></script>
</body>
</html>