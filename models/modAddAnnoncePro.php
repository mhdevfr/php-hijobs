<?php

function add_annonce_pro($titreAnnonce, $descriptionAnnonce, $localisation, $typeContrat, $idEntreprise) {
    global $connexion;


    try {
        $req = $connexion->prepare("INSERT INTO annoncepro (titreAnnoncePro, descAnnoncePro, villeAnnoncePro, typeContrat, idEntreprise) VALUES (?, ?, ?, ?, ?)");
        $result = $req->execute([$titreAnnonce, $descriptionAnnonce, $localisation, $typeContrat, $idEntreprise]);
        if (!$result) {
            throw new PDOException("Échec de l'insertion");
        }
        return true;
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout de l'annonce : " . $e->getMessage());
        echo "Erreur lors de l'ajout de l'annonce : " . $e->getMessage();
        return false;
    }
}