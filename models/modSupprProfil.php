<?php

function supprProfil($userId, $userType) {
    global $connexion;
    
    try {
        switch($userType) {
            case 'particulier':
                $stmt = $connexion->prepare('DELETE FROM particulier WHERE idParti = ?');
                break;
                
            case 'etudiant':
                $stmt = $connexion->prepare('DELETE FROM etudiant WHERE idEtudiant = ?');
                break;
                
            case 'entreprise':
                $stmt = $connexion->prepare('DELETE FROM professionelle WHERE idEntreprise = ?');
                break;
                
            default:
                return false;
        }
        
        if ($stmt->execute([$userId])) {
            session_start();
            session_destroy();
            return $stmt->rowCount() > 0;
        }
        
        return false;
        
    } catch(PDOException $e) {
        error_log("Erreur lors de la suppression du profil : " . $e->getMessage());
        return false;
    }
}
function checkUserExists($userId, $userType) {
    global $connexion;
    
    try {
        switch($userType) {
            case 'particulier':
                $stmt = $connexion->prepare('SELECT COUNT(*) FROM particulier WHERE idParti = ?');
                break;
                
            case 'etudiant':
                $stmt = $connexion->prepare('SELECT COUNT(*) FROM etudiant WHERE idEtudiant = ?');
                break;
                
            case 'entreprise':
                $stmt = $connexion->prepare('SELECT COUNT(*) FROM professionelle WHERE idEntreprise = ?');
                break;
                
            default:
                return false;
        }
        
        $stmt->execute([$userId]);
        return $stmt->fetchColumn() > 0;
        
    } catch(PDOException $e) {
        error_log("Erreur lors de la vérification de l'existence de l'utilisateur : " . $e->getMessage());
        return false;
    }
}
