<?php
include_once('models/modParticulier.php');
include_once('models/modGetActiviteParti.php');

$idParticulier = $_SESSION['idParti'];

$particulier = get_particulier($idParticulier);
$mission = getActiviteParti($connexion);

include_once('views/user/vue_modifProfil.php');