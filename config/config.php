<?php
$username = "adminJobs";
$servername = "localhost";
$password = "admin";
try{
    $connexion = new PDO("mysql:host=$servername;dbname=apjobs_final",$username,$password);
}
catch(Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}





?>