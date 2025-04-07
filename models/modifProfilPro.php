<?php

require_once('./models/modModifProfilPro.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEntreprise = $_POST['idEntreprise'] ?? null;
    $NomEntreprise = $_POST['nomEntreprise'];
    $CodePostalPro = $_POST['codePostal'];
    $Ville = $_POST['ville'];
    $AdresseEntreprise = $_POST['AdresseEntreprise'];
    $Pays = $_POST['pays'];
    $TelephoneEntreprise = $_POST['telephoneEntreprise'];
    $siteweb = $_POST['siteWeb'];
    $EmailEntreprise = $_POST['emailEntreprise'];
    $NumeroSiret = $_POST['NumeroSiret'];
    $SecteurActivite = $_POST['secteurActivite'];

    $result = modifProfilPro($idEntreprise, $NomEntreprise, $CodePostalPro, $Ville, $AdresseEntreprise, $Pays, $TelephoneEntreprise, $siteweb, $EmailEntreprise, $NumeroSiret, $SecteurActivite);

    if ($result) {
        $_SESSION['success'] = "Profil mis à jour avec succès";
        header('Location: index.php?section=acc-off');
        exit;
    } else {
        $_SESSION['error'] = "Une erreur est survenue lors de la mise à jour du profil.";
        header('Location: index.php?section=modifProfilPro');
        exit;
    }
}