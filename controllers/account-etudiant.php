<?php


include_once('models/modEtudiant.php');
$idEtudiant = $_SESSION['idEtudiant'];

$etudiant = get_etudiant($idEtudiant);





include_once('views/vue_etudiant.php');
?>
