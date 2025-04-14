<?php
// Controller qui gère l'affichage du formulaire de modification d'une annonce
$numAnnonce = $_GET['idAnnonce'];

include_once('models/modFormAnnonce.php');
include_once('models/modTypeContrat.php');

// Vérifier et récupère les données de l'annonce à modifier
$annonceModif = getOffreur($connexion, $numAnnonce);
$TypeContrat = get_type_de_contrat();

include_once('views/dashboardOffreur/vue_ModifFormAnnonce.php');
