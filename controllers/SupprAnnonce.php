<?php
include_once('models/modSupprAnnonce.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $numAnnonce = isset($_POST['numAnnonce']) ? intval($_POST['numAnnonce']) : 0;
    
    if ($numAnnonce > 0) {
        $result = deleteAnnonce($connexion, $numAnnonce);
        
        if ($result) {
            header('Location: index.php?section=annoncePoste&success=deleted');
        } else {
            header('Location: index.php?section=annoncePoste&error=delete_failed');
        }
    } else {
        header('Location: index.php?section=annoncePoste&error=invalid_annonce');
    }
    exit();
} else {
    header('Location: index.php?section=annoncePoste');
    exit();
}
