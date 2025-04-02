<?php

require_once('./models/modModifProfilEtu.php');


if (!empty($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $idEtudiant = $_POST['idEtudiant'] ?? null;
    $nomEtudiant = $_POST['nom'];
    $prenomEtudiant = $_POST['prenom'];
    $codePostal = $_POST['codePostal'];
    $villeEtudiant = $_POST['ville'];
    $adresseEtudiant = $_POST['adresse'];
    $Pays = $_POST['pays'];
    $telephoneEtudiant = $_POST['telephone'];
    $EmailEtudiant = $_POST['emailEtudiant'];
    $niveauEtude = $_POST['niveauEtude'];
    $nomFormation = $_POST['nomFormation'];
    

    $result = modifProfilEtu($idEtudiant, $nomEtudiant, $prenomEtudiant, $codePostal, $villeEtudiant, $adresseEtudiant, $Pays, $telephoneEtudiant, $EmailEtudiant, $niveauEtude, $nomFormation );

    if ($result) {
        header('Location: index.php?section=acc-etu');
        exit;
    } else {
        $error = "Une erreur est survenue lors de la mise à jour du profil.";
    }
}