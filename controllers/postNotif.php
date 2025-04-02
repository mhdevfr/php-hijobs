<?php
include_once('models/modPostuler.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $annonceId = intval($_POST['annonce_id']);
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
    $etudiantId = $_SESSION['idEtudiant'];
    $result = envoyerCandidature($annonceId, $etudiantId, $message);

    if ($result) {
        echo "Votre candidature a été envoyée avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi de votre candidature.";
    }
}
?>