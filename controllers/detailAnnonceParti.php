<?php
$numAnnonce = $_GET["choixId"];

include_once('models/modAnnoncesParti.php');
$annonceChoisi = detailAnnonceParti($numAnnonce);

include_once('views/annonces/vue_detailAnnoncesParti.php');