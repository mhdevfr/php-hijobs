<?php
// Controller qui permet de gérer l'inscription d'un étudiant
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = "adminJobs";
    $servername = "localhost";
    $passwordServ = "admin";
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $nomEtudiant = $_POST['nomEtudiant'];
    $prenomEtudiant = $_POST['prenomEtudiant'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];


    $codePostalEtudiant = $_POST['codePostalEtudiant'];
    $villeEtudiant = $_POST['villeEtudiant'];
    $adresseEtudiant = $_POST['adresseEtudiant'];
    $paysEtudiant = $_POST['paysEtudiant'];
    $telephoneEtudiant = $_POST['telephoneEtudiant'];
    $mailEtudiant = $_POST['mailEtudiant'];
    $niveauEtude = $_POST['niveauEtude'];
    $nomFormation = $_POST['nomFormation'];

    $requeteSql = "INSERT INTO etudiant (nom, prenom, codePostal, Ville, Adresse, Pays, Telephone, EmailEtudiant, NiveauEtude, NomFormation, password) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $etat = $connexion->prepare($requeteSql);

    if ($password !== $passwordConf) {
        echo "Les mots de passes ne sont pas identiques veuillez recommencer";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($etat->execute([$nomEtudiant, $prenomEtudiant, $codePostalEtudiant, $villeEtudiant, $adresseEtudiant, $paysEtudiant, $telephoneEtudiant, $mailEtudiant, $niveauEtude, $nomFormation, $hash])) {
            echo "Vous êtes bien enregistré";
            header('Location: index.php');
        } else {
            echo "Une erreur est survenue";
        }
    }
}

include_once("views/user/vue_connexion.php");
