<?php
// Controller qui gère l'affichage de la page d'accueil de l'étudiant
include_once('models/modEtudiant.php');

// Récupère les données de l'étudiant connecté
$idEtudiant = $_SESSION['idEtudiant'];
$etudiant = get_etudiant($idEtudiant);

include_once('views/vue_etudiant.php');
