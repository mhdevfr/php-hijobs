<?php

$titreAnnonce = $_POST['titreAnnonce'];
$intitEntreprise = $_POST['intitEntreprise'];
$localisation = $_POST['localisation'];
$typeContrat = $_POST['typeContrat'];
$descriptionAnnonce = $_POST['descriptionAnnonce'];

include './models/modAddAnnonces.php';
include './models/modentreprise.php';

$connexion->beginTransaction();

$idEntreprise = get_entreprises($intitEntreprise);

if ($idEntreprise) {
    if (add_Annonce($titreAnnonce, $idEntreprise, $localisation, $typeContrat, $descriptionAnnonce, $numUser)) {
        $connexion->commit();
        header('Location: index.php');
    } else {
        echo "Erreur lors de l'ajout de l'annonce.";
        $connexion->rollBack();
    }
} else {
    echo "Erreur lors de l'ajout de l'entreprise.";
    $connexion->rollBack();
}
