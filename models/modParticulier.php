<?php
// Permet de récupérer les informations d'un particulier
function get_particulier($idParticulier)
{
    global $connexion;
    $req = $connexion->prepare("SELECT * FROM particulier WHERE idParti = ?");
    $req->execute([$idParticulier]);
    $particulier = $req->fetchAll(PDO::FETCH_ASSOC);

    if ($particulier) {
        return $particulier;
    }

    error_log("Aucun particulier trouvé avec l'id : " . $idParticulier);
    return [];
}

// Permet de récupérer l'id d'un particulier selon son nom et prénom
function get_particulier2($nomParticulier, $prenomParticulier)
{
    global $connexion;

    $req = $connexion->prepare("SELECT idParti FROM particulier WHERE NomParti = ? AND PrenomParti = ?");  
    $req->execute([$nomParticulier, $prenomParticulier]);
    $idParti = $req->fetchColumn();

    if ($idParti) {
        return $idParti;
    }

    error_log("Aucun particulier trouvé avec le Nom et Prénom : " . $nomParticulier . " " . $prenomParticulier);
    return null;
}