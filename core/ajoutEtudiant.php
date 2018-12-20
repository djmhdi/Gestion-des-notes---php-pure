<?php
// require('checkSession.php');

if(!empty($_POST["add_record"])) {
  require_once("connection.php");
  $data = [
    'nom'       =>$_POST["nom"],
    'prenom'    =>$_POST["prenom"],
    'filiere'   =>$_POST["filiere"] 
  ];
	$sql = "INSERT INTO etudiants (nom,prenom,filiere) VALUES ( :nom, :prenom, :filiere )";
	$statement = $pdo->prepare( $sql );
  $result = $statement->execute($data);
	if (!empty($result) ){
	  header('location:etudiants.php');
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
            <h2>Etudiants</h2>
          </div> 
        </div>  
        <div class="row">
          <div class="col-md-12">
            <form method="POST">
              <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" required>
              </div>
              <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" name="prenom" required>
              </div>
              <div class="form-group">
                <label for="filiere">Filière</label>
                <input type="text" class="form-control" name="filiere" required>
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
