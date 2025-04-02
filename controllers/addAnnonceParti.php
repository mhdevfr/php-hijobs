<?php

$titreAnnonce = $_POST['titreAnnonce'];
$localisation = $_POST['localisation'];
$nomParticulier = $_POST['NomParti'];
$prenomParticulier = $_POST['PrenomParti'];
$descriptionAnnonce = $_POST['descriptionAnnonce'];

include './models/modAddAnnonceParti.php';
include './models/modParticulier.php';

$idParti = get_particulier2($nomParticulier, $prenomParticulier);

$connexion->beginTransaction();

if ($idParti) {
    if (add_annonce_parti($titreAnnonce, $localisation, $idParti, $descriptionAnnonce)) {
        $connexion->commit();
        header('Location: index.php?section=annonce');
            exit();
    } else {
        echo "Erreur lors de l'ajout de l'annonce.";
        $connexion->rollBack();
    }
} else {
    echo "Erreur : Aucun particulier trouvé avec ce nom et prénom.";
    $connexion->rollBack();
}
?>