<?php
// Controller qui gère l'affichage du formulaire de modification du profil professionnel
session_start();
if (!isset($_SESSION['idEntreprise'])) {
    $_SESSION['error'] = "Session expirée, veuillez vous reconnecter";
    header('Location: index.php?section=login');
    exit;
}

include_once('models/modProfesionnelle.php');
include_once('models/modGetActivite.php');

// Vérifie si l'utilisateur est connecté et récupère ses données
$idProfessionelle = $_SESSION['idEntreprise'];
$professionelle = get_profesionnelle($idProfessionelle);
$ActiviteEntreprise = getActivite($connexion);

include_once('views/user/vue_modifProfilPro.php');
