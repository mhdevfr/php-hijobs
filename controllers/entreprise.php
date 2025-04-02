<?php


include_once('models/modAfficherEntreprise.php');
$entreprises = afficher_entreprise(); 
include_once('views/entreprises/vue_index.php');
?>