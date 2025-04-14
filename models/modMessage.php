<?php
// Modèle pour gérer les messages
// Fonction pour envoyer un message
function envoyerMessage($connexion, $expediteur, $destinataire, $annonce, $contenu) {
    try {
        error_log("Tentative d'envoi de message - Données: " . json_encode([
            'expediteur' => $expediteur,
            'destinataire' => $destinataire,
            'annonce' => $annonce
        ]));
        
        $fields = [
            'idParti' => null,
            'idEntreprise' => null,
            'idEtudiant' => null,
            'numAnnonceParti' => null,
            'numAnnoncePro' => null,
            'contenuMessage' => $contenu,
            'dateEnvoi' => date('Y-m-d H:i:s'),
            'lu' => 0
        ];
        
        if (isset($destinataire['type']) && isset($destinataire['id'])) {
            switch($destinataire['type']) {
                case 'particulier':
                    $fields['idParti'] = $destinataire['id'];
                    break;
                case 'pro':
                    $fields['idEntreprise'] = $destinataire['id'];
                    break;
                case 'etudiant':
                    $fields['idEtudiant'] = $destinataire['id'];
                    break;
            }
        }

        if (isset($annonce['type']) && isset($annonce['id'])) {
            if ($annonce['type'] === 'particulier') {
                $fields['numAnnonceParti'] = $annonce['id'];
            } else {
                $fields['numAnnoncePro'] = $annonce['id'];
            }
        }
        
        if (isset($expediteur['type']) && isset($expediteur['id'])) {
            $expediteurInfo = "Envoyé par: " . $expediteur['type'] . " (ID: " . $expediteur['id'] . ")\n\n";
            $fields['contenuMessage'] = $expediteurInfo . $contenu;
        }
        
        $columns = [];
        $placeholders = [];
        $params = [];
        
        foreach ($fields as $column => $value) {
            if (in_array($column, ['expediteur_particulier', 'expediteur_entreprise', 'expediteur_etudiant'])) {
                continue;
            }
            
            $columns[] = $column;
            $placeholders[] = ':' . $column;
            $params[':' . $column] = $value;
        }
        
        $query = "INSERT INTO messages (" . implode(', ', $columns) . ") 
                  VALUES (" . implode(', ', $placeholders) . ")";
                  
        error_log("Requête SQL: " . $query);
        error_log("Paramètres: " . print_r($params, true));
        
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


// Récupère les messages reçus
function getMessagesRecus($connexion, $userType, $userId) {
    try {
        if (empty($userId)) {
            error_log("ID utilisateur vide pour getMessagesRecus");
            return [];
        }
        
        error_log("Récupération des messages reçus - Type: $userType, ID: $userId");
        
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

        switch($userType) {
            case 'particulier':
                $query .= "m.idParti = :id";
                break;
            case 'pro':
                $query .= "m.idEntreprise = :id";
                break;
            case 'etudiant':
                $query .= "m.idEtudiant = :id";
                break;
            default:
                error_log("Type d'utilisateur non reconnu: $userType");
                return [];
        }

        $query .= " ORDER BY m.dateEnvoi DESC";
        
        error_log("Requête SQL pour messages reçus: " . $query);
        
        $stmt = $connexion->prepare($query);
        $stmt->execute([':id' => $userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("Nombre de messages reçus trouvés: " . count($result));
        return $result;
    } catch (PDOException $e) {
        error_log("Erreur de récupération des messages reçus: " . $e->getMessage());
        return [];
    }
}

/**
 * Récupère les messages envoyés
 */
function getMessagesEnvoyes($connexion, $userType, $userId) {
    try {
        if (empty($userId)) {
            error_log("ID utilisateur vide pour getMessagesEnvoyes");
            return [];
        }
        
        error_log("Récupération des messages envoyés - Type: $userType, ID: $userId");

        
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
                 WHERE m.contenuMessage LIKE :expediteur_id
                 ORDER BY m.dateEnvoi DESC";
                 
        $params = [':expediteur_id' => "%Envoyé par: " . $userType . " (ID: " . $userId . ")%"];
        
        error_log("Requête SQL pour messages envoyés: " . $query);
        error_log("Paramètres: " . json_encode($params));
        
        $stmt = $connexion->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("Nombre de messages envoyés trouvés: " . count($result));
        return $result;
    } catch (PDOException $e) {
        error_log("Erreur de récupération des messages envoyés: " . $e->getMessage());
        return [];
    }
}

// Met les messages comme lus
function marquerCommeLu($connexion, $idMessage) {
    try {
        $query = "UPDATE messages SET lu = TRUE WHERE idMessage = :idMessage";
        $stmt = $connexion->prepare($query);
        $result = $stmt->execute([':idMessage' => $idMessage]);
        
        error_log("Message marqué comme lu - ID: $idMessage, Résultat: " . ($result ? "Succès" : "Échec"));
        return $result;
    } catch (PDOException $e) {
        error_log("Erreur de marquage du message: " . $e->getMessage());
        return false;
    }
}

// Récupère l'ID de l'utilisateur selon le type
function recupererIdUtilisateur($connexion, $userType) {
    try {
        switch ($userType) {
            case 'particulier':
                $query = "SELECT idParti FROM particulier LIMIT 1";
                $stmt = $connexion->query($query);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result['idParti'] : null;
                
            case 'pro':
                $query = "SELECT idEntreprise FROM professionelle LIMIT 1";
                $stmt = $connexion->query($query);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result['idEntreprise'] : null;
                
            case 'etudiant':
                $query = "SELECT idEtudiant FROM etudiant LIMIT 1";
                $stmt = $connexion->query($query);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result['idEtudiant'] : null;
                
            default:
                return null;
        }
    } catch (PDOException $e) {
        error_log("Erreur de récupération d'ID utilisateur: " . $e->getMessage());
        return null;
    }
}

// Récupère les messages non lus
function getNombreMessagesNonLus($connexion, $userType, $userId) {
    try {
        if (empty($userId)) {
            return 0;
        }
        
        $condition = "";
        switch($userType) {
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
        
        $query = "SELECT COUNT(*) as nombre FROM messages WHERE $condition AND lu = FALSE";
        $stmt = $connexion->prepare($query);
        $stmt->execute([':id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($result['nombre']);
    } catch (PDOException $e) {
        error_log("Erreur de comptage des messages: " . $e->getMessage());
        return 0;
    }
}
