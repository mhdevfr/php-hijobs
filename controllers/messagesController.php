<?php
require_once('./models/modMessage.php');

function afficherMessages() {
    global $connexion;
    
    if (!isset($_SESSION['userType'])) {
        return [];
    }
    
    if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
        error_log("ID utilisateur non défini pour l'affichage des messages");
        
        $tempId = recupererIdUtilisateur($connexion, $_SESSION['userType']);
        if ($tempId) {
            $_SESSION['userId'] = $tempId;
            error_log("ID temporairement récupéré: " . $tempId);
        } else {
            error_log("Impossible de récupérer un ID utilisateur temporaire");
            return [];
        }
    }
    
    return getMessagesRecus($connexion, $_SESSION['userType'], $_SESSION['userId']);
}

function afficherMessagesEnvoyes() {
    global $connexion;
    
    if (!isset($_SESSION['userType'])) {
        return [];
    }
    
    if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
        error_log("ID utilisateur non défini pour l'affichage des messages envoyés");
        
        $tempId = recupererIdUtilisateur($connexion, $_SESSION['userType']);
        if ($tempId) {
            $_SESSION['userId'] = $tempId;
            error_log("ID temporairement récupéré: " . $tempId);
        } else {
            error_log("Impossible de récupérer un ID utilisateur temporaire");
            return [];
        }
    }
    
    return getMessagesEnvoyes($connexion, $_SESSION['userType'], $_SESSION['userId']);
}

function marquerMessageLu() {
    global $connexion;
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['idMessage'])) {
        header('Location: index.php?section=messages&error=parametres_manquants');
        exit;
    }
    
    if (marquerCommeLu($connexion, $_POST['idMessage'])) {
        header('Location: index.php?section=messages&success=message_lu');
    } else {
        header('Location: index.php?section=messages&error=echec_marquer_lu');
    }
    exit;
}

function repondreMessage() {
    global $connexion;
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?section=messages');
        exit;
    }
    
    if (!isset($_SESSION['userType']) || !isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
        $_SESSION['error'] = "Vous devez être connecté pour envoyer un message";
        header('Location: index.php?section=connecter');
        exit;
    }
    
    if (!isset($_POST['message']) || empty($_POST['message'])) {
        $_SESSION['error'] = "Le message ne peut pas être vide";
        header('Location: index.php?section=messages');
        exit;
    }
    $expediteur = [
        'type' => $_SESSION['userType'],
        'id' => $_SESSION['userId']
    ];
    
    $destinataire = [];
    if (isset($_POST['destinataire_type']) && isset($_POST['destinataire_id'])) {
        $destinataire = [
            'type' => $_POST['destinataire_type'],
            'id' => $_POST['destinataire_id']
        ];
    }
    
    $annonce = [];
    if (isset($_POST['numAnnonceParti']) && !empty($_POST['numAnnonceParti'])) {
        $annonce = [
            'type' => 'particulier',
            'id' => $_POST['numAnnonceParti']
        ];
    } elseif (isset($_POST['numAnnoncePro']) && !empty($_POST['numAnnoncePro'])) {
        $annonce = [
            'type' => 'pro',
            'id' => $_POST['numAnnoncePro']
        ];
    }
    
    if (envoyerMessage($connexion, $expediteur, $destinataire, $annonce, $_POST['message'])) {
        header('Location: index.php?section=messages&success=message_envoye');
    } else {
        header('Location: index.php?section=messages&error=envoi_echoue');
    }
    exit;
}

function envoyerMessageAnnonce() {
    global $connexion;
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?section=annonces');
        exit;
    }
    if (!isset($_SESSION['userType']) || !isset($_SESSION['userId'])) {
        $_SESSION['error'] = "Vous devez être connecté pour envoyer un message";
        header('Location: index.php?section=connecter');
        exit;
    }
    
    if ($_SESSION['userType'] !== 'etudiant') {
        $_SESSION['error'] = "Seuls les étudiants peuvent postuler aux annonces";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    
    if (!isset($_POST['message']) || empty($_POST['message'])) {
        $_SESSION['error'] = "Le message ne peut pas être vide";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    
    $expediteur = [
        'type' => 'etudiant',
        'id' => $_SESSION['userId']
    ];
    
    $destinataire = [];
    $annonce = [];
    
    if (isset($_POST['numAnnonceParti']) && !empty($_POST['numAnnonceParti'])) {
        $annonce = [
            'type' => 'particulier',
            'id' => $_POST['numAnnonceParti']
        ];
        
        try {
            $stmt = $connexion->prepare("SELECT idParti FROM annonceparticulier WHERE numAnnonceParti = :id");
            $stmt->execute([':id' => $_POST['numAnnonceParti']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                $destinataire = [
                    'type' => 'particulier',
                    'id' => $result['idParti']
                ];
            } else {
                throw new Exception("Annonce introuvable");
            }
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération du propriétaire de l'annonce: " . $e->getMessage());
            $_SESSION['error'] = "Erreur lors de la récupération des informations de l'annonce";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } elseif (isset($_POST['numAnnoncePro']) && !empty($_POST['numAnnoncePro'])) {
        $annonce = [
            'type' => 'pro',
            'id' => $_POST['numAnnoncePro']
        ];
        
        try {
            $stmt = $connexion->prepare("SELECT idEntreprise FROM annoncepro WHERE numAnnoncePro = :id");
            $stmt->execute([':id' => $_POST['numAnnoncePro']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                $destinataire = [
                    'type' => 'pro',
                    'id' => $result['idEntreprise']
                ];
            } else {
                throw new Exception("Annonce introuvable");
            }
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération du propriétaire de l'annonce: " . $e->getMessage());
            $_SESSION['error'] = "Erreur lors de la récupération des informations de l'annonce";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {
        $_SESSION['error'] = "Aucune annonce spécifiée";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    
    if (envoyerMessage($connexion, $expediteur, $destinataire, $annonce, $_POST['message'])) {
        $_SESSION['success'] = "Votre candidature a été envoyée avec succès";
        header('Location: index.php?section=messages');
    } else {
        $_SESSION['error'] = "Échec de l'envoi de votre candidature";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    exit;
}