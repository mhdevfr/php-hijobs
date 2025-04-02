<?php


include_once('models/modAnnonces.php');
$annonces = getAnnonces(); 
include_once('views/annonces/vue_index.php');
?>