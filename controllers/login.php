<?php
include_once('./config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    function checkUser($connexion, $table, $emailField, $email, $password) {
        $requeteSql = "SELECT * FROM $table WHERE $emailField = ?";
        $etat = $connexion->prepare($requeteSql);
        $etat->execute([$email]);
        $user = $etat->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    $user = checkUser($connexion, 'etudiant', 'EmailEtudiant', $email, $password);
    $userType = 'etudiant';

    if (!$user) {
        $user = checkUser($connexion, 'professionelle', 'EmailEntreprise', $email, $password);
        $userType = 'professionnel';
    }

    if (!$user) {
        $user = checkUser($connexion, 'particulier', 'Email', $email, $password);
        $userType = 'particulier';
    }

    if ($user) {
        $_SESSION['validiteConnexion'] = true;
        $_SESSION['userType'] = $userType;
        $_SESSION['email'] = $email;

        switch ($userType) {
            case 'etudiant':
                $_SESSION['idEtudiant'] = $user['idEtudiant'];
                unset($_SESSION['idEntreprise'], $_SESSION['idParti']);
                $_SESSION['nomUser'] = $user['nom'];
                $_SESSION['prenomUser'] = $user['prenom'];
                header('Location: index.php?section=acc-etu');
                break;
            case 'professionnel':
                $_SESSION['idEntreprise'] = $user['idEntreprise'];
                unset($_SESSION['idEtudiant'], $_SESSION['idParti']);
                $_SESSION['nomEntreprise'] = $user['NomEntreprise'];
                header('Location: index.php?section=acc-off');
                break;
            case 'particulier':
                $_SESSION['idParti'] = $user['idParti'];
                unset($_SESSION['idEtudiant'], $_SESSION['idEntreprise']);
                $_SESSION['nomUser'] = $user['NomParti'];
                $_SESSION['prenomUser'] = $user['PrenomParti'];
                header('Location: index.php?section=acc-parti');
                break;
        }
        
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}

if (isset($_GET['section']) && $_GET['section'] == 'acc-etu' && (!isset($_SESSION['validiteConnexion']) || $_SESSION['userType'] != 'etudiant')) {
    header('Location: index.php?section=connexion');
    exit();
}

include_once('views/user/vue_connexion.php');
?>