<?php
// Permet de modifier un profil utilisateur d'un étudiant
function modifProfilEtu($p_idEtudiant, $p_nom, $p_prenom, $p_codePostal, $p_ville, $p_adresse, $p_pays, $p_telephone, $p_emailEtudiant, $p_niveauEtude, $p_nomFormation)
{
    global $connexion;

    $sql = "UPDATE etudiant 
            SET nom = :nom, prenom = :prenom, codePostal = :codepostal, 
                Ville = :ville, Adresse = :adresse, Pays = :pays, 
                Telephone = :telephone, EmailEtudiant = :emailEtudiant, NiveauEtude = :niveauEtude, NomFormation = :nomFormation
            WHERE idEtudiant = :id";

    $req = $connexion->prepare($sql);


    $req->bindParam(':nom', $p_nom);
    $req->bindParam(':prenom', $p_prenom);
    $req->bindParam(':codepostal', $p_codePostal);
    $req->bindParam(':ville', $p_ville);
    $req->bindParam(':adresse', $p_adresse);
    $req->bindParam(':pays', $p_pays);
    $req->bindParam(':telephone', $p_telephone);
    $req->bindParam(':emailEtudiant', $p_emailEtudiant);
    $req->bindParam(':niveauEtude', $p_niveauEtude);
    $req->bindParam(':nomFormation', $p_nomFormation);
    $req->bindParam(':id', $p_idEtudiant, PDO::PARAM_INT);

    return $req->execute();
}