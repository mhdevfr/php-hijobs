<?php
// Controller qui gère l'affichage du formulaire de modification de profil d'un particulier
include_once('models/modParticulier.php');
include_once('models/modGetActiviteParti.php');

// Vérifie si l'utilisateur est connecté et récupère ses données
$idParticulier = $_SESSION['idParti'];
$particulier = get_particulier($idParticulier);
$mission = getActiviteParti($connexion);

include_once('views/user/vue_modifProfil.php');
