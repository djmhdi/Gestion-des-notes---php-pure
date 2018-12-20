<?php
require('checkSession.php');

  require('connection.php');
  /*-----Liste des semestres-----*/
	$statement = $pdo->prepare("SELECT * FROM semestres ORDER BY id ASC");
	$statement->execute();
  $semestres = $statement->fetchAll();
  /*-----Liste des modules-----*/
	$statement = $pdo->prepare("SELECT * FROM modules ORDER BY id ASC");
	$statement->execute();
  $modules = $statement->fetchAll();
  /*-----Liste des semestres-----*/
	$statement = $pdo->prepare("SELECT * FROM etudiants ORDER BY num ASC");
	$statement->execute();
  $etudiants = $statement->fetchAll();
  // var_dump($modules);
if(!empty($_POST["add_record"])) {
  // var_dump($_POST["semestre"]);
  // require_once("connection.php");
  $data = [
    'note'          =>  $_POST["note"],
    'etudiant'      =>  $_POST["etudiant"],
    'semestre'      =>  $_POST["semestre"] ,
    'module'        =>  $_POST["module"] 
  ];
	$sql = "INSERT INTO notes  VALUES ( :note, :etudiant, :semestre , :module)";
	$statement = $pdo->prepare( $sql );
  $result = $statement->execute($data);
	if (!empty($result) ){
	  header('location:notes.php');
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
            <h2>Notes</h2>
          </div> 
        </div>  
        <div class="row">
          <div class="col-md-12">
            <form method="POST">
              <div class="form-group">
                <label for="semestre">Semestre</label>
                <select name="semestre" class="form-control">
                  <?php
                  if(!empty($semestres)) { 
                    foreach($semestres as $row) {
                  ?>
                  <option value="<?php echo $row["id"]?>"><?php echo $row["intitule"]?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="module">Module</label>
                <select name="module" class="form-control">
                  <?php
                  if(!empty($modules)) { 
                    foreach($modules as $row) {
                  ?>
                  <option value="<?php echo $row["id"]?>"><?php echo $row["intitule"]?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="etudiant">Filiere - Etudiant</label>
                <select name="etudiant" class="form-control">
                  <?php
                  if(!empty($etudiants)) { 
                    foreach($etudiants as $row) {
                  ?>
                  <option value="<?php echo $row["num"]?>"><?php echo $row["filiere"]." - ".$row["nom"]." ".$row["prenom"]?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="note">note</label>
                <input type="number" class="form-control" name="note" required>
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
