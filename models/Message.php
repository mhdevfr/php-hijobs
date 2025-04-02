<?php
class Message {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function envoyerMessage($expediteur, $destinataire, $annonce, $contenu) {
        try {
            $query = "INSERT INTO messages (
                idParti,
                idEntreprise,
                idEtudiant,
                numAnnonceParti,
                numAnnoncePro,
                contenuMessage
            ) VALUES (
                :idParti,
                :idEntreprise,
                :idEtudiant,
                :numAnnonceParti,
                :numAnnoncePro,
                :contenu
            )";

            $params = [
                ':idParti' => null,
                ':idEntreprise' => null,
                ':idEtudiant' => null,
                ':numAnnonceParti' => null,
                ':numAnnoncePro' => null,
                ':contenu' => $contenu
            ];

            switch($expediteur['type']) {
                case 'particulier':
                    $params[':idParti'] = $expediteur['id'];
                    break;
                case 'entreprise':
                    $params[':idEntreprise'] = $expediteur['id'];
                    break;
                case 'etudiant':
                    $params[':idEtudiant'] = $expediteur['id'];
                    break;
            }

            if (isset($annonce['type']) && isset($annonce['id'])) {
                if ($annonce['type'] === 'particulier') {
                    $params[':numAnnonceParti'] = $annonce['id'];
                } else {
                    $params[':numAnnoncePro'] = $annonce['id'];
                }
            }

            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erreur d'envoi de message: " . $e->getMessage());
            return false;
        }
    }

    
    public function getMessagesRecus($type, $id) {
        try {
            $conditions = [];
            $params = [];

            switch($type) {
                case 'particulier':
                    $conditions[] = "m.idParti = :id";
                    break;
                case 'entreprise':
                    $conditions[] = "m.idEntreprise = :id";
                    break;
                case 'etudiant':
                    $conditions[] = "m.idEtudiant = :id";
                    break;
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

            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération des messages: " . $e->getMessage());
            return [];
        }
    }

    public function marquerCommeLu($idMessage) {
        try {
            $query = "UPDATE messages SET lu = TRUE WHERE idMessage = :idMessage";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([':idMessage' => $idMessage]);
        } catch (PDOException $e) {
            error_log("Erreur de marquage du message: " . $e->getMessage());
            return false;
        }
    }

    public function supprimerMessage($idMessage, $idUtilisateur) {
        try {
            $query = "UPDATE messages 
                     SET supprime = TRUE 
                     WHERE idMessage = :idMessage 
                     AND (idExpediteur = :idUtilisateur OR idDestinataire = :idUtilisateur)";
            
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':idMessage' => $idMessage,
                ':idUtilisateur' => $idUtilisateur
            ]);
        } catch (PDOException $e) {
            error_log("Erreur de suppression du message: " . $e->getMessage());
            return false;
        }
    }

    public function getNombreMessagesNonLus($idUtilisateur) {
        try {
            $query = "SELECT COUNT(*) as nombre 
                     FROM messages 
                     WHERE idDestinataire = :id 
                     AND lu = FALSE 
                     AND supprime = FALSE";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute([':id' => $idUtilisateur]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['nombre'];
        } catch (PDOException $e) {
            error_log("Erreur de comptage des messages: " . $e->getMessage());
            return 0;
        }
    }
} 