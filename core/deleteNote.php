<?php
require('checkSession.php');

require_once("connection.php");
$sql="DELETE FROM notes WHERE num_etudiant=:num_etudiant AND id_semestre=:id_semestre AND id_module=:id_module;";
$statement = $pdo->prepare($sql);
$statement->execute(array(
    "num_etudiant" => $_GET["etudiant"],
    "id_semestre" => $_GET["semestre"],
    "id_module" => $_GET["module"],
));
header("location:notes.php");
?>