<?php

function modifProfilPro($p_idEntreprise, $p_nomEntreprise, $p_codePostal, $p_ville, $p_adresseEntreprise, $p_pays, $p_telephoneEntreprise, $p_siteWeb, $p_emailEntreprise, $p_numeroSiret, $p_secteurActivite)
{
    global $connexion;

    $sql = "UPDATE professionelle 
            SET NomEntreprise = :nomEntreprise, CodePostal = :codePostal, Ville = :ville, 
                AdresseEntreprise = :adresseEntreprise, Pays = :pays, TelephoneEntreprise = :telephoneEntreprise, 
                SiteWeb = :siteWeb, EmailEntreprise = :emailEntreprise, NumeroSiret = :numeroSiret, SecteurActivite = :secteurActivite
                /* Taille = :taille */
            WHERE idEntreprise = :id";

    $req = $connexion->prepare($sql);


    $req->bindParam(':nomEntreprise', $p_nomEntreprise);
    $req->bindParam(':codePostal', $p_codePostal);
    $req->bindParam(':ville', $p_ville);
    $req->bindParam(':adresseEntreprise', $p_adresseEntreprise);
    $req->bindParam(':pays', $p_pays);
    $req->bindParam(':telephoneEntreprise', $p_telephoneEntreprise);
    $req->bindParam(':siteWeb', $p_siteWeb);
    $req->bindParam(':emailEntreprise', $p_emailEntreprise);
    $req->bindParam(':numeroSiret', $p_numeroSiret);
    $req->bindParam(':secteurActivite', $p_secteurActivite);
    //$req->bindParam(':taille', $p_taille);
    $req->bindParam(':id', $p_idEntreprise, PDO::PARAM_INT);

    return $req->execute();
}