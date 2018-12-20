<?php
require('checkSession.php');
require('connection.php');

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FSSM - PROG web</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <style type="text/css" media="screen">
	  /* .box{
		margin-top: 100px;

	  }

	.box-module{
		background-color: #A35119;
		margin-top: 10px;
		margin-bottom: 10px;
		margin-right: 15px;
		padding: 50px;
		border-radius: 5px;
		color : #ffff;
		text-align: center;
	} */
  .bg-dark {
	    background-color:#A35119!important;
	}
  .logo{
    margin-top:60px;
    text-align: center;
  }
  </style>
  <body>

    <!-- Navigation -->
    <?php include("navbar.php")?>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-md-12 logo">
          <img src="../img/logo.png" alt="UCA" width="300" height="500">
        </div>
      </div>
      	<!-- <div class="row box">
	      	<div class="col-md-3 offset-md-3 box-module">
	      		jjj
	      	</div>
	      	<div class="col-md-3 box-module">
	      		ddd
	      	</div>
      	</div>
    	<div class="row">
	      	<div class="col-md-3 offset-md-3 box-module">
	      		rrr
	      	</div>
	      	<div class="col-md-3 box-module">
	      		qqq
	      	</div>
      	</div> -->
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
