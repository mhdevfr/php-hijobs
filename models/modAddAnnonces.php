<?php
// Modèle pour ajouter une annonce de professionnel
function add_annonce_parti($titreAnnonce, $localisation, $idParti, $descriptionAnnonce) {
    global $connexion;



    try {
        $req = $connexion->prepare("INSERT INTO annonceparticulier (titreAnnonce, villeAnnonceParti, idParti, descriptionParti) VALUES (?, ?, ?, ?)");
        $result = $req->execute([$titreAnnonce, $localisation, $idParti, $descriptionAnnonce]);
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