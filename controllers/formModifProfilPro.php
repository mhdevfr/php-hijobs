<?php
include_once('models/modProfesionnelle.php');
include_once('models/modGetTaille.php');
include_once('models/modGetActivite.php');

$idProfessionelle = $_SESSION['idEntreprise'];

$professionelle = get_profesionnelle($idProfessionelle);

//$tailleEntreprise = getTaille($connexion);

$ActiviteEntreprise = getActivite($connexion);

include_once('views/user/vue_modifProfilPro.php');