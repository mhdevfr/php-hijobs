<?php
// Controller qui gère l'affichage du formulaire de modification du profil d'un étudiant
include_once('models/modEtudiant.php');

// Vérifie si l'utilisateur est connecté et récupère son les données de l'étudiant
$idEtudiant = $_SESSION['idEtudiant'];
$etudiant = get_etudiant($idEtudiant);

include_once('views/user/vue_modifProfilEtu.php');
