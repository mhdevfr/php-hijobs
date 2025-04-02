<?php

function modifProfil($p_idParti, $p_nomParti, $p_prenomParti, $p_adresseParti, $p_codePostalParti, $p_ville, $p_pays, $p_telephone, $p_siteweb, $p_email, $p_typeMission)
{
    global $connexion;

    $sql = "UPDATE particulier 
            SET NomParti = :nomParti, PrenomParti = :prenomParti, AdresseParti = :adresseParti, 
                CodePostalParti = :codePostalParti, Ville = :ville, Pays = :pays, 
                Telephone = :telephone, SiteWeb = :siteweb, Email = :email, TypeMission = :typeMission
            WHERE idParti = :id";

    $req = $connexion->prepare($sql);


    $req->bindParam(':nomParti', $p_nomParti);
    $req->bindParam(':prenomParti', $p_prenomParti);
    $req->bindParam(':adresseParti', $p_adresseParti);
    $req->bindParam(':codePostalParti', $p_codePostalParti);
    $req->bindParam(':ville', $p_ville);
    $req->bindParam(':pays', $p_pays);
    $req->bindParam(':telephone', $p_telephone);
    $req->bindParam(':siteweb', $p_siteweb);
    $req->bindParam(':email', $p_email);
    $req->bindParam(':typeMission', $p_typeMission);
    $req->bindParam(':id', $p_idParti, PDO::PARAM_INT);

    return $req->execute();
}