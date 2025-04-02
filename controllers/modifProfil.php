<?php

require_once('./models/modModifProfil.php');


if (!empty($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $idParti = $_POST['idParti'] ?? null;
    $nomParti = $_POST['nomParti'];
    $prenomParti = $_POST['prenomParti'];
    $adresseParti = $_POST['adresseParti'];
    $codePostalParti = $_POST['codePostalParti'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $siteweb = $_POST['siteWeb'];
    $email = $_POST['email'];
    $typeMission = $_POST['typeMission'];

    $result = modifProfil($idParti, $nomParti, $prenomParti, $adresseParti, $codePostalParti, $ville, $pays, $telephone, $siteweb, $email, $typeMission);

    if ($result) {
        header('Location: index.php?section=acc-parti');
        exit;
    } else {
        $error = "Une erreur est survenue lors de la mise à jour du profil.";
    }
}