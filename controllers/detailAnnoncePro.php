<?php
$numAnnonce = $_GET["choixId"];
include_once('models/modAnnoncesPro.php');
$annonceChoisi = detailAnnoncePro($numAnnonce);
include_once('models/modGetActivite.php');
include_once('models/modTypeContrat.php');
$activite = getActivite($connexion);
$contrat = get_type_de_contrat($connexion);
include_once('views/annonces/vue_detailAnnoncesPro.php');