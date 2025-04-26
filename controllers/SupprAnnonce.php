<?php
// Controller qui permet de gérer la suppression d'une annonce
include_once('models/modSupprAnnonce.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $numAnnonce = isset($_POST['numAnnonce']) ? intval($_POST['numAnnonce']) : 0;

    // Vérifie si l'annonce existe
    if ($numAnnonce > 0) {
        $redirectBase = isset($_SESSION['idEntreprise']) ? 'index.php?section=annoncePoste' : 'index.php?section=annoncePoste';
        
        echo "<script>
            if (confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')) {
                " . ($result = deleteAnnonce($connexion, $numAnnonce) ? "true" : "false") . ";
                
                if (" . ($result ? "true" : "false") . ") {
                    window.location.href = '$redirectBase&success=deleted';
                } else {
                    window.location.href = '$redirectBase&error=delete_failed';
                }
            } else {
                window.location.href = '$redirectBase';
            }
        </script>";
        exit();
    } else {
        header('Location: index.php?section=annoncePoste&error=invalid_annonce');
    }
    exit();
} else {
    header('Location: index.php?section=annoncePoste');
    exit();
}
