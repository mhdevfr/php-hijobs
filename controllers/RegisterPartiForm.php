<?php
// Controller qui permet de gérer l'inscription d'un particulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = "adminJobs";
    $servername = "localhost";
    $passwordServ = "admin";
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $nomParticulier = $_POST['nomParticulier'];
    $prenomParticulier = $_POST['prenomParticulier'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    $adresseParticulier = $_POST['adresseParticulier'];
    $codePostalParticulier = $_POST['codePostalParticulier'];
    $villeParticulier = $_POST['villeParticulier'];
    $paysParticulier = $_POST['paysParticulier'];
    $telephoneParticulier = $_POST['telephoneParticulier'];
    $sitewebParticulier = $_POST['siteWebParticulier'];
    $mailParticulier = $_POST['mailParticulier'];
    $typeMission = $_POST['mission'];

    $requeteSql = "INSERT INTO particulier (NomParti, PrenomParti, AdresseParti, CodePostalParti, Ville, Pays, Telephone, SiteWeb, Email, TypeMission, password) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $etat = $connexion->prepare($requeteSql);

    if ($password !== $passwordConf) {
        echo "Les mots de passes ne sont pas identiques veuillez recommencer";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($etat->execute([$nomParticulier, $prenomParticulier, $adresseParticulier, $codePostalParticulier, $villeParticulier, $paysParticulier, $telephoneParticulier, $sitewebParticulier, $mailParticulier, $typeMission, $hash])) {
            echo "Vous êtes bien enregistré";
            header('Location: index.php');
        } else {
            echo "Une erreur est survenue";
        }
    }
}


include_once("views/user/vue_connexion.php");
