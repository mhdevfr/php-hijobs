<?php
// Controller qui gère la supression du profil d'un utilisateur
include_once('models/modSupprProfil.php');

// Vérifie si l'utilisateur est connecté
$userType = $_SESSION['userType'];
supprProfil($idParticulier, $userType);

include_once('controllers/logout.php');
