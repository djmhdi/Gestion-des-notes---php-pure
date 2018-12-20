<?php
require('checkSession.php');

require_once("connection.php");
$sql="DELETE FROM modules WHERE id=:id";
$statement = $pdo->prepare($sql);
$statement->execute(array("id" => $_GET["id"]));
header("location:modules.php");
?>