<?php
// Controller qui gère l'affichage des détails d'une entreprise
$identifiant = $_GET["choixId"];

include_once('models/modentreprise.php');

// Récupère les détails de l'entreprise
$entrepriseChoisie = detailEntreprise($identifiant);

include_once('views/entreprises/vue_detail.php');
