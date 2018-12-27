<?php
/**
 * sert a établir une connexion à la base de données
 */
$hostname = "localhost";
$dbname = "etudiants";
$username = "root";
$password = "";
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
    //echo("db connecté !!<br>");
} catch (Exception $ex) {
    echo("db Error !!");
    die();
}
