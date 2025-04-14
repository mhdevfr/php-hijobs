<?php
// Controller qui permet d'envoyer une candidature à une annonce 
include_once('models/modPostuler.php');

// Vérifie l'envoie des données de la candidature
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $annonceId = intval($_POST['annonce_id']);
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
    $etudiantId = $_SESSION['idEtudiant'];
    $result = envoyerCandidature($annonceId, $etudiantId, $message);

    // Vérifie si la requête a été exécutée avec succès
    // Si oui, redirige vers la page d'accueil
    if ($result) {
        echo "Votre candidature a été envoyée avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi de votre candidature.";
    }
}
