<?php

include_once('models/modSupprProfil.php');

$userType = 'etudiant';
$userId = $_SESSION['idEtudiant'];

supprProfil($userId, $userType);

include_once('controllers/logout.php'); 