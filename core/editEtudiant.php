<?php
require('checkSession.php');

require_once("connection.php");

$id = null;
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ( null==$id ) {
    header("Location: etudiants.php");
}
if ( !empty($_POST)) {
    $sql = "UPDATE etudiants SET nom=:nom,prenom=:prenom,filiere=:filiere WHERE num=:num";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute(array(
        "nom"       => $_POST["nom"],
        "prenom"    => $_POST["prenom"],
        "filiere"   => $_POST["filiere"],
        "num"       => $id
    ));
    header("Location: etudiants.php");
}else{
    $sql="SELECT * FROM etudiants WHERE num=:num";
    //$pdo->execute(array('num'=>$id));
    $statement = $pdo->prepare( $sql );
    $statement->execute(array('num'=>$id));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
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
                <input type="text" class="form-control" name="nom" value="<?php echo $result["nom"]?>" required>
              </div>
              <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" name="prenom" value="<?php echo $result["prenom"]?>" required>
              </div>
              <div class="form-group">
                <label for="filiere">Filière</label>
                <input type="text" class="form-control" name="filiere" value="<?php echo $result["filiere"]?>" required>
              </div>
              <button type="submit" class="btn btn-primary">Modifier</button>
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
