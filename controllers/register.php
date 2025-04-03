<?php
include('./config/config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_reporting(E_ALL); 
    ini_set("display_errors", 1);
    
    // Vérification de la présence des champs requis
    if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['passconf']) || 
        !isset($_POST['name']) || !isset($_POST['lastname']) || !isset($_POST['userType'])) {
        $_SESSION['error'] = "Tous les champs sont obligatoires";
        header('Location: index.php?section=enregistrer');
        exit();
    }
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passconf'];
    $prenomUser = $_POST['name'];
    $nomUser = $_POST['lastname'];
    $userType = $_POST['userType']; 
    
    if($password !== $passwordConf){
        $_SESSION['error'] = "Les mots de passe ne sont pas identiques";
        header('Location: index.php?section=enregistrer');
        exit();
    }

    // Validation du type d'utilisateur
    $types_valides = ['pro', 'etudiant', 'particulier'];
    if (!in_array($userType, $types_valides)) {
        $_SESSION['error'] = "Type d'utilisateur non valide";
        header('Location: index.php?section=enregistrer');
        exit();
    }
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        switch($userType) {
            case 'pro':
                $requeteSql = "INSERT INTO professionelle (NomEntreprise, EmailEntreprise, password) VALUES (?, ?, ?)";
                $etat = $connexion->prepare($requeteSql);
                
                if($etat->execute([$nomUser, $email, $hash])){
                    $_SESSION['userType'] = 'pro';
                    $_SESSION['userId'] = $connexion->lastInsertId();
                    $_SESSION['userName'] = $nomUser;
                    
                    header('Location: index.php');
                    exit();
                }
                break;

            case 'etudiant':
                $requeteSql = "INSERT INTO etudiant (nom, prenom, EmailEtudiant, password) VALUES (?, ?, ?, ?)";
                $etat = $connexion->prepare($requeteSql);
                
                if($etat->execute([$nomUser, $prenomUser, $email, $hash])){
                    $_SESSION['userType'] = 'etudiant';
                    $_SESSION['userId'] = $connexion->lastInsertId();
                    $_SESSION['userName'] = $prenomUser;
                    
                    header('Location: index.php');
                    exit();
                }
                break;

            case 'particulier':
                $requeteSql = "INSERT INTO particulier (NomParti, PrenomParti, Email, password) VALUES (?, ?, ?, ?)";
                $etat = $connexion->prepare($requeteSql);
                
                if($etat->execute([$nomUser, $prenomUser, $email, $hash])){
                    $_SESSION['userType'] = 'particulier';
                    $_SESSION['userId'] = $connexion->lastInsertId();
                    $_SESSION['userName'] = $prenomUser;
                    
                    header('Location: index.php');
                    exit();
                }
                break;
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = "Une erreur est survenue lors de l'inscription : " . $e->getMessage();
        header('Location: index.php?section=enregistrer');
        exit();
    }
}

// Afficher les erreurs s'il y en a
if (isset($_SESSION['error'])) {
    echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}

include_once('views/user/vue_inscription.php');
?>