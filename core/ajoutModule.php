<?php
require('checkSession.php');

if(!empty($_POST["add_record"])) {
  require_once("connection.php");
  $data = [
    'intitule'       =>$_POST["intitule"],
  ];
	$sql = "INSERT INTO modules (intitule) VALUES ( :intitule )";
	$statement = $pdo->prepare( $sql );
  $result = $statement->execute($data);
	if (!empty($result) ){
	  header('location:modules.php');
	}
}
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
    .bg-dark {
            background-color:#A35119!important;
        }
    .content{
        margin-top:80px;
    }
    .titre{
      margin-bottom:10px
    }
    .titre h2{
      display:inline;
    }
    .titre .btn{
      float : right;
    }
  </style>
  <body>

    <!-- Navigation -->
    <?php include("navbar.php")?>

    <!-- Page Content -->
    <div class="container">
      <div class="content"> 
        <div class="row">
          <div class="col-md-12 titre">
            <h2>Modules</h2>
          </div> 
        </div>  
        <div class="row">
          <div class="col-md-12">
            <form method="POST">
              <div class="form-group">
                <label for="intitule">Intitule</label>
                <input type="text" class="form-control" name="intitule" required>
              </div>
              <button type="submit" class="btn btn-primary" name="add_record" value="Add">Ajouter</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
