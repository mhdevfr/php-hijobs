<?php
// Controller qui gère l'affichage de la page d'accueil du particulier
include_once('models/modParticulier.php');

// Récupère les données du particulier connecté
$idParticulier = $_SESSION['idParti'];
$particulier = get_particulier($idParticulier);

include_once('views/vue_particulier.php');
