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

    // Initialiser les variables
    $numAnnoncePro = null;
    $numAnnonceParti = null;
    $villeAnnonce = '';
    $description = '';
    $typeContrat = '';
    $titreAnnonce = '';

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
            $villeAnnonce = $_POST['villeAnnonceParti'];
            $description = $_POST['descriptionAnnonceParti'];
            $typeContrat = ''; // Les particuliers n'ont pas de type de contrat, mais on initialise quand même
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        error_log("Erreur dans modifAnnonce controller: " . $e->getMessage());
    }

    // Débogage pour voir ce qui est envoyé à la fonction
    error_log("Paramètres pour modifAnnonce: ");
    error_log("titreAnnonce: " . $titreAnnonce);
    error_log("villeAnnonce: " . $villeAnnonce);
    error_log("description: " . $description);
    error_log("numAnnoncePro: " . ($numAnnoncePro ?? 'null'));
    error_log("numAnnonceParti: " . ($numAnnonceParti ?? 'null'));

    $result = modifAnnonce($connexion, $titreAnnonce, $villeAnnonce, $description, $typeContrat, $numAnnoncePro, $numAnnonceParti);

    // Vérifie si la requête a été exécutée avec succès
    // Si oui, redirige vers la page d'accueil
    if ($result) {
        if ($proId) {
            header('Location: index.php?section=annoncePoste');
        } else {
            header('Location: index.php?section=annonce');
        }
        exit;
    } else {
        $error = "Une erreur est survenue lors de la mise à jour de votre annonce.";
        error_log("Échec de la mise à jour de l'annonce");
    }
}
