<?php
require('checkSession.php');

require_once("connection.php");

$id = null;
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ( null==$id ) {
    header("Location: semestres.php");
}
if ( !empty($_POST)) {
    $sql = "UPDATE semestres SET intitule=:intitule WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute(array(
        "intitule"       => $_POST["intitule"],
        "id"       => $id
    ));
    header("Location: semestres.php");
}else{
    $sql="SELECT * FROM semestres WHERE id=:id";
    $statement = $pdo->prepare( $sql );
    $statement->execute(array('id'=>$id));
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
            <h2>Semestres</h2>
          </div> 
        </div>  
        <div class="row">
          <div class="col-md-12">
            <form method="POST">
              <div class="form-group">
                <label for="intitule">Intitule</label>
                <input type="text" class="form-control" name="intitule" value="<?php echo $result["intitule"]?>" required>
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
