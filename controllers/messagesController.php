<?php
function afficherMessages() {
    global $connexion;
    
    if (!isset($_SESSION['userType']) || !isset($_SESSION['userId'])) {
        return [];
    }

    try {
        $query = "SELECT m.*, 
                    p.NomParti, p.PrenomParti,
                    pro.NomEntreprise,
                    e.nom as nom_etudiant, e.prenom as prenom_etudiant,
                    ap.titreAnnonce as titre_annonce_parti,
                    apro.titreAnnoncePro as titre_annonce_pro
                 FROM messages m
                 LEFT JOIN particulier p ON m.idParti = p.idParti
                 LEFT JOIN professionelle pro ON m.idEntreprise = pro.idEntreprise
                 LEFT JOIN etudiant e ON m.idEtudiant = e.idEtudiant
                 LEFT JOIN annonceparticulier ap ON m.numAnnonceParti = ap.numAnnonceParti
                 LEFT JOIN annoncepro apro ON m.numAnnoncePro = apro.numAnnoncePro
                 WHERE ";

        switch($_SESSION['userType']) {
            case 'particulier':
                $query .= "m.idParti = :id";
                break;
            case 'entreprise':
                $query .= "m.idEntreprise = :id";
                break;
            case 'etudiant':
                $query .= "m.idEtudiant = :id";
                break;
        }

        $query .= " ORDER BY m.dateEnvoi DESC";

        $stmt = $connexion->prepare($query);
        $stmt->execute([':id' => $_SESSION['userId']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération des messages : " . $e->getMessage());
        return [];
    }
}

function marquerCommeLu() {
    global $connexion;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idMessage'])) {
        try {
            $stmt = $connexion->prepare("UPDATE messages SET lu = TRUE WHERE idMessage = :id");
            $stmt->execute([':id' => $_POST['idMessage']]);
            header('Location: index.php?section=messages&success=message_lu');
            exit;
        } catch (PDOException $e) {
            error_log("Erreur lors du marquage du message : " . $e->getMessage());
            header('Location: index.php?section=messages&error=1');
            exit;
        }
    }
}

function repondre() {
    global $connexion;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $query = "INSERT INTO messages (
                idParti,
                idEntreprise,
                idEtudiant,
                contenuMessage,
                dateEnvoi
            ) VALUES (
                :idParti,
                :idEntreprise,
                :idEtudiant,
                :message,
                NOW()
            )";

            $params = [
                ':idParti' => null,
                ':idEntreprise' => null,
                ':idEtudiant' => null,
                ':message' => $_POST['message']
            ];

            switch($_POST['destinataire_type']) {
                case 'particulier':
                    $params[':idParti'] = $_POST['destinataire_id'];
                    break;
                case 'entreprise':
                    $params[':idEntreprise'] = $_POST['destinataire_id'];
                    break;
                case 'etudiant':
                    $params[':idEtudiant'] = $_POST['destinataire_id'];
                    break;
            }

            $stmt = $connexion->prepare($query);
            $result = $stmt->execute($params);

            if ($result) {
                header('Location: index.php?section=messages&success=reponse_envoyee');
                exit;
            }
        } catch (PDOException $e) {
            error_log("Erreur lors de l'envoi de la réponse : " . $e->getMessage());
        }
    }
    
    header('Location: index.php?section=messages&error=1');
    exit;
}