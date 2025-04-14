<?php
// Controller qui permet d'afficher les annonces que l'on à poster sois même
include_once("models/modAnnoncePoste.php");

$annoncePoste = annoncePoste($connexion);

include_once("views/dashboardOffreur/vue_TotalAnnonce.php");
