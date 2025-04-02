<?php

include_once("models/modAnnoncePoste.php");

$annoncePoste = annoncePoste($connexion);

include_once("views/dashboardOffreur/vue_TotalAnnonce.php");