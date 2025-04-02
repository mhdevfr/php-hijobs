<?php
include('./config/config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_reporting(E_ALL); 
    ini_set("display_errors", 1);
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passconf'];
    $prenomUser = $_POST['name'];
    $nomUser = $_POST['lastname'];
    $pro = $_POST['pro']; 
    
    if($password !== $passwordConf){
        echo "Les mots de passes ne sont pas identiques veuillez recommencer";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            if($pro == "1") {
                $requeteSql = "INSERT INTO professionelle (NomEntreprise, PrenomEntreprise, EmailEntreprise, MdpEntreprise) VALUES (?, ?, ?, ?)";
                $etat = $connexion->prepare($requeteSql);
                
                if($etat->execute([$nomUser, $prenomUser, $email, $hash])){
                    $_SESSION['userType'] = 'entreprise';
                    $_SESSION['userId'] = $connexion->lastInsertId();
                    $_SESSION['userName'] = $nomUser;
                    
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Une erreur est survenue lors de l'enregistrement de l'entreprise";
                }
            } 
            else {
                $requeteSql = "INSERT INTO particulier (NomParti, PrenomParti, EmailParti, MdpParti) VALUES (?, ?, ?, ?)";
                $etat = $connexion->prepare($requeteSql);
                
                if($etat->execute([$nomUser, $prenomUser, $email, $hash])){
                    $_SESSION['userType'] = 'particulier';
                    $_SESSION['userId'] = $connexion->lastInsertId();
                    $_SESSION['userName'] = $prenomUser;
                    
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Une erreur est survenue lors de l'enregistrement du particulier";
                }
            }
        } catch(PDOException $e) {
            echo "Une erreur est survenue: " . $e->getMessage();
        }
    }
}

include_once('views/user/vue_inscription.php');
?>