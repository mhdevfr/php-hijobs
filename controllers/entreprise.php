<?php
// Controller qui gère l'affichage des entreprises
include_once('models/modAfficherEntreprise.php');

// Récupère les données des entreprises 
$entreprises = afficher_entreprise();

include_once('views/entreprises/vue_index.php');
