<?php 

$identifiant = $_GET["choixId"];

include_once('models/modentreprise.php');
$entrepriseChoisie = detailEntreprise($identifiant); 

include_once('views/entreprises/vue_detail.php');
?>