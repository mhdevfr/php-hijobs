<?php
function envoyerMessage($connexion, $expediteur, $destinataire, $annonce, $contenu) {
    try {
        error_log("Envoi de message - Expéditeur: " . print_r($expediteur, true));
        error_log("Envoi de message - Annonce: " . print_r($annonce, true));
        
        $query = "INSERT INTO messages (
            idParti,
            idEntreprise,
            idEtudiant,
            numAnnonceParti,
            numAnnoncePro,
            contenuMessage,
            dateEnvoi,
            lu
        ) VALUES (
            :idParti,
            :idEntreprise,
            :idEtudiant,
            :numAnnonceParti,
            :numAnnoncePro,
            :contenu,
            NOW(),
            0
        )";

        $params = [
            ':idParti' => null,
            ':idEntreprise' => null,
            ':idEtudiant' => null,
            ':numAnnonceParti' => null,
            ':numAnnoncePro' => null,
            ':contenu' => $contenu
        ];

        // Définir l'expéditeur selon son type
        switch($expediteur['type']) {
            case 'particulier':
                $params[':idParti'] = $expediteur['id'];
                break;
            case 'pro':
                $params[':idEntreprise'] = $expediteur['id'];
                break;
            case 'etudiant':
                $params[':idEtudiant'] = $expediteur['id'];
                break;
        }

        // Définir l'annonce liée si elle existe
        if (isset($annonce['type']) && isset($annonce['id'])) {
            if ($annonce['type'] === 'particulier') {
                $params[':numAnnonceParti'] = $annonce['id'];
            } else {
                $params[':numAnnoncePro'] = $annonce['id'];
            }
        }

        $stmt = $connexion->prepare($query);
        $result = $stmt->execute($params);
        
        if ($result) {
            error_log("Message inséré avec succès, ID: " . $connexion->lastInsertId());
        } else {
            error_log("Échec de l'insertion: " . print_r($stmt->errorInfo(), true));
        }
        
        return $result;
    } catch (PDOException $e) {
        error_log("Erreur d'envoi de message: " . $e->getMessage());
        return false;
    }
}

/**
 * Récupère les messages reçus par un utilisateur
 */
function getMessagesRecus($connexion, $type, $id) {
    try {
        $conditions = [];
        $params = [];

        switch($type) {
            case 'particulier':
                $conditions[] = "m.idParti = :id";
                break;
            case 'pro':
                $conditions[] = "m.idEntreprise = :id";
                break;
            case 'etudiant':
                $conditions[] = "m.idEtudiant = :id";
                break;
            default:
                error_log("Type d'utilisateur non reconnu: " . $type);
                return [];
        }

        $params[':id'] = $id;

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
                 WHERE " . implode(' AND ', $conditions) . "
                 ORDER BY m.dateEnvoi DESC";

        error_log("Requête getMessagesRecus: " . $query);
        error_log("Params: " . print_r($params, true));

        $stmt = $connexion->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("Nombre de messages trouvés: " . count($result));
        
        return $result;
    } catch (PDOException $e) {
        error_log("Erreur de récupération des messages: " . $e->getMessage());
        return [];
    }
}

/**
 * Récupère les messages envoyés par un utilisateur
 */
function getMessagesEnvoyes($connexion, $type, $id) {
    try {
        $conditions = [];
        $params = [];

        switch($type) {
            case 'particulier':
                $conditions[] = "(m.idParti = :id AND (m.idEntreprise IS NOT NULL OR m.idEtudiant IS NOT NULL))";
                break;
            case 'pro':
                $conditions[] = "(m.idEntreprise = :id AND (m.idParti IS NOT NULL OR m.idEtudiant IS NOT NULL))";
                break;
            case 'etudiant':
                $conditions[] = "(m.idEtudiant = :id AND (m.idParti IS NOT NULL OR m.idEntreprise IS NOT NULL))";
                break;
            default:
                error_log("Type d'utilisateur non reconnu: " . $type);
                return [];
        }

        $params[':id'] = $id;

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
                 WHERE " . implode(' AND ', $conditions) . "
                 ORDER BY m.dateEnvoi DESC";

        error_log("Requête getMessagesEnvoyes: " . $query);
        
        $stmt = $connexion->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de récupération des messages envoyés: " . $e->getMessage());
        return [];
    }
}

/**
 * Marque un message comme lu
 */
function marquerCommeLu($connexion, $idMessage) {
    try {
        $query = "UPDATE messages SET lu = TRUE WHERE idMessage = :idMessage";
        $stmt = $connexion->prepare($query);
        return $stmt->execute([':idMessage' => $idMessage]);
    } catch (PDOException $e) {
        error_log("Erreur de marquage du message: " . $e->getMessage());
        return false;
    }
}

/**
 * Supprime un message (marquage logique)
 */
function supprimerMessage($connexion, $idMessage, $idUtilisateur) {
    try {
        $query = "UPDATE messages 
                 SET supprime = TRUE 
                 WHERE idMessage = :idMessage 
                 AND (idExpediteur = :idUtilisateur OR idDestinataire = :idUtilisateur)";
        
        $stmt = $connexion->prepare($query);
        return $stmt->execute([
            ':idMessage' => $idMessage,
            ':idUtilisateur' => $idUtilisateur
        ]);
    } catch (PDOException $e) {
        error_log("Erreur de suppression du message: " . $e->getMessage());
        return false;
    }
}

/**
 * Compte les messages non lus
 */
function getNombreMessagesNonLus($connexion, $type, $idUtilisateur) {
    try {
        $condition = "";
        switch($type) {
            case 'particulier':
                $condition = "idParti = :id";
                break;
            case 'pro':
                $condition = "idEntreprise = :id";
                break;
            case 'etudiant':
                $condition = "idEtudiant = :id";
                break;
            default:
                return 0;
        }
        
        $query = "SELECT COUNT(*) as nombre 
                 FROM messages 
                 WHERE $condition 
                 AND lu = FALSE";
        
        $stmt = $connexion->prepare($query);
        $stmt->execute([':id' => $idUtilisateur]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($result['nombre']);
    } catch (PDOException $e) {
        error_log("Erreur de comptage des messages: " . $e->getMessage());
        return 0;
    }
}
?> 