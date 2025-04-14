<?php
// Controller qui permet d'afficher les détails d'une annonce d'une entreprise
$numAnnonce = $_GET["choixId"];

include_once('models/modAnnoncesPro.php');

// Récupère les détails de l'annonce professionnelle
$annonceChoisi = detailAnnoncePro($numAnnonce);

include_once('models/modGetActivite.php');
include_once('models/modTypeContrat.php');

// Vérifie et récupère les données de l'entreprise connecté
$activite = getActivite($connexion);
$contrat = get_type_de_contrat($connexion);
include_once('views/annonces/vue_detailAnnoncesPro.php');
