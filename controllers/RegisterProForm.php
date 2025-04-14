<?php
// Controller qui permet de gérer l'inscription d'un professionnel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = "adminJobs";
    $servername = "localhost";
    $passwordServ = "admin";
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $nomEntreprise = $_POST['nomEntreprise'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];


    $codePostalEntreprise = $_POST['codePostalEntreprise'];
    $villeEntreprise = $_POST['villeEntreprise'];
    $adresseEntreprise = $_POST['adresseEntreprise'];
    $paysEntreprise = $_POST['paysEntreprise'];
    $telephoneEntreprise = $_POST['telephoneEntreprise'];
    $siteWebEntreprise = $_POST['siteWebEntreprise'];
    $mailEntreprise = $_POST['mailEntreprise'];
    $numeroSiret = $_POST['siret'];
    $secteurActivite = $_POST['secteurActivite'];
    // $tailleEntreprise = $_POST['tailleEntreprise'];

    $requeteSql = "INSERT INTO professionelle (NomEntreprise, CodePostal, Ville, AdresseEntreprise, Pays, TelephoneEntreprise, SiteWeb, EmailEntreprise, NumeroSiret, SecteurActivite, Taille, password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $etat = $connexion->prepare($requeteSql);

    if ($password !== $passwordConf) {
        echo "Les mots de passes ne sont pas identiques veuillez recommencer";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($etat->execute([$nomEntreprise, $codePostalEntreprise, $villeEntreprise, $adresseEntreprise, $paysEntreprise, $telephoneEntreprise, $siteWebEntreprise, $mailEntreprise, $numeroSiret, $secteurActivite, $hash])) {
            echo "Vous êtes bien enregistré";
            header('Location: index.php');
        } else {
            echo "Une erreur est survenue";
        }
    }
}
include_once("views/user/vue_connexion.php");
