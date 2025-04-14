<?php
// Controller qui gère l'ajout d'une annonce par un particulier
$titreAnnonce = $_POST['titreAnnonce'];
$localisation = $_POST['localisation'];
$nomParticulier = $_POST['NomParti'];
$prenomParticulier = $_POST['PrenomParti'];
$descriptionAnnonce = $_POST['descriptionAnnonce'];

include './models/modAddAnnonceParti.php';
include './models/modParticulier.php';
// Récupère les données du particulier connecté
$idParti = get_particulier2($nomParticulier, $prenomParticulier);

// Vérifier et ajoute une annonce d'un particulier
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
