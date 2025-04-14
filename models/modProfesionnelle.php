<?php
// Permet d'obtenir les informations sur les professionnelles
function get_profesionnelle($idProfessionelle)
{
    global $connexion;

    $req = $connexion->prepare(query: "SELECT * FROM professionelle WHERE idEntreprise = ?");
    $req->execute([$idProfessionelle]);
    $profesionelle = $req->fetchAll(PDO::FETCH_ASSOC);

    if ($profesionelle) {
        return $profesionelle;
    }

    error_log("Aucun particulier trouvé avec l'id : " . $idProfessionelle);
    return [];
}