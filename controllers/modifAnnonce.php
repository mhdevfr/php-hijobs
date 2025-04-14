<?php
// Controller qui permet de modifier une annonce
include_once('models/modModifAnnonce.php');

// Vérifie l'envoie des données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $proId = $_SESSION['idEntreprise'] ?? null;
    $partiId = $_SESSION['idParti'] ?? null;

    if (!$proId && !$partiId) {
        return [];
    }

    // Vérifie sur l'utilisateur est un professionnel ou un particulier
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

    // Vérifie si la requête a été exécutée avec succès
    // Si oui, redirige vers la page d'accueil
    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Une erreur est survenue lors de la mise à jour de votre annonce.";
    }
}
