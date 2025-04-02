<?php


$numAnnonce = $_GET['idAnnonce'];


include_once('models/modFormAnnonce.php');
include_once('models/modTypeContrat.php');

$annonceModif = getOffreur($connexion, $numAnnonce);

$TypeContrat = get_type_de_contrat();





include_once('views/dashboardOffreur/vue_ModifFormAnnonce.php');