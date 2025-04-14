<?php
// Controller qui gère l'affichage des annonces
include_once('models/modAnnonces.php');

// Récupère les annonces 
$annonces = getAnnonces();

include_once('views/annonces/vue_index.php');
