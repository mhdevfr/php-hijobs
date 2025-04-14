<?php
// Permet de modifier le profil utilisateur d'un professionnel
function modifProfilPro($p_idEntreprise, $p_nomEntreprise, $p_codePostal, $p_ville, $p_adresseEntreprise, $p_pays, $p_telephoneEntreprise, $p_siteWeb, $p_emailEntreprise, $p_numeroSiret, $p_secteurActivite)
{
    global $connexion;
    
    try {
        // Log pour debug
        error_log("Tentative de modification pour l'entreprise ID: " . $p_idEntreprise);
        
        $sql = "UPDATE professionelle 
                SET NomEntreprise = :nomEntreprise,
                    CodePostal = :codePostal,
                    Ville = :ville,
                    AdresseEntreprise = :adresseEntreprise,
                    Pays = :pays,
                    TelephoneEntreprise = :telephoneEntreprise,
                    SiteWeb = :siteWeb,
                    EmailEntreprise = :emailEntreprise,
                    NumeroSiret = :numeroSiret,
                    SecteurActivite = :secteurActivite
                WHERE idEntreprise = :id";

        $req = $connexion->prepare($sql);
        
        // Conversion des types
        $telephoneInt = intval($p_telephoneEntreprise);
        $siretInt = intval($p_numeroSiret);
        
        $req->bindValue(':nomEntreprise', $p_nomEntreprise, PDO::PARAM_STR);
        $req->bindValue(':codePostal', $p_codePostal, PDO::PARAM_STR);
        $req->bindValue(':ville', $p_ville, PDO::PARAM_STR);
        $req->bindValue(':adresseEntreprise', $p_adresseEntreprise, PDO::PARAM_STR);
        $req->bindValue(':pays', $p_pays, PDO::PARAM_STR);
        $req->bindValue(':telephoneEntreprise', $telephoneInt, PDO::PARAM_INT);
        $req->bindValue(':siteWeb', $p_siteWeb, PDO::PARAM_STR);
        $req->bindValue(':emailEntreprise', $p_emailEntreprise, PDO::PARAM_STR);
        $req->bindValue(':numeroSiret', $siretInt, PDO::PARAM_INT);
        $req->bindValue(':secteurActivite', $p_secteurActivite, PDO::PARAM_STR);
        $req->bindValue(':id', $p_idEntreprise, PDO::PARAM_INT);

        $result = $req->execute();
        
        if (!$result) {
            error_log("Erreur SQL: " . print_r($req->errorInfo(), true));
        }
        
        return $result;
    } catch (PDOException $e) {
        error_log("Exception dans modifProfilPro: " . $e->getMessage());
        return false;
    }
}