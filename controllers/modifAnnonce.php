<?php
include_once('models/modModifAnnonce.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $proId = $_SESSION['idEntreprise'] ?? null;
    $partiId = $_SESSION['idParti'] ?? null;

    if (!$proId && !$partiId) {
        return [];
    }

    try {
        if ($proId) {
            $numAnnoncePro = $_POST['numAnnoncePro'] ?? null;
            $titreAnnonce = $_POST['titreAnnoncePro'];
            $nomEntreprise = $_POST['nomEntreprise'];
            $villeAnnonce = $_POST['villeAnnoncePro'];
            $description = $_POST['descriptionAnnoncePro'];
            $typeContrat = $_POST['typeContrat'];
        } else {
            $numAnnonceParti = $_POST['numAnnonceParti'] ?? null;
            $titreAnnonce = $_POST['titreAnnonceParti'];
            $nomParticulier = $_POST['nomParti'];
            $prenomParticulier = $_POST['prenomParti'];
            $ville = $_POST['villeAnnonceParti'];
            $descriptionAnnonce = $_POST['descriptionAnnonceParti'];
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }


    $result = modifAnnonce($connexion, $titreAnnonce, $villeAnnonce, $description, $typeContrat, $numAnnoncePro, $numAnnonceParti);

    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Une erreur est survenue lors de la mise à jour de votre annonce.";
    }

}

