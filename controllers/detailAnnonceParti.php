<?php
// Controller qui permet d'affiche le détail d'une annonce particulier
$numAnnonce = $_GET["choixId"];

include_once('models/modAnnoncesParti.php');

// Récupère les détails de l'annonce particulier
$annonceChoisi = detailAnnonceParti($numAnnonce);

include_once('views/annonces/vue_detailAnnoncesParti.php');
