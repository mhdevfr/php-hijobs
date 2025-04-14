<?php
// Controller qui gère l'ajout d'une annonce d'une entreprise
$titreAnnonce = $_POST['titreAnnonce'];
$intitEntreprise = $_POST['intitEntreprise'];
$localisation = $_POST['localisation'];
$typeContrat = $_POST['typeContrat'];
$descriptionAnnonce = $_POST['descriptionAnnonce'];

include './models/modAddAnnoncePro.php';
include './models/modentreprise.php';

// Récupère les données de l'entreprise connecté
$idEntreprise = get_entreprises($intitEntreprise);

// Vérifie et ajoute une annonce d'une entreprise
$connexion->beginTransaction();

if ($idEntreprise) {
    if (add_annonce_pro($titreAnnonce, $descriptionAnnonce, $localisation, $typeContrat, $idEntreprise)) {
        $connexion->commit();
        header('Location: index.php');
        exit();
    } else {
        $connexion->rollBack();
    }
} else {
    echo "Erreur : Aucune entreprise trouvé avec ce nom et prénom.";
    $connexion->rollBack();
}
