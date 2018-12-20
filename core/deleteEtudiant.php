<?php
require('checkSession.php');

require_once("connection.php");
$sql="DELETE FROM etudiants WHERE num=:num";
$statement = $pdo->prepare($sql);
$statement->execute(array("num" => $_GET["id"]));
header("location:etudiants.php");

?>