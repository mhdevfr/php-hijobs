<?php
// Modèle pour gérer les étudiants
// Fonction qui permet d'obtenir toutes les informations sur les étudiants
function get_etudiant($idEtudiant)
{
    global $connexion;

    $req = $connexion->prepare("SELECT * FROM etudiant WHERE idEtudiant = ?");
    $req->execute([$idEtudiant]);
    $etudiant = $req->fetchAll(PDO::FETCH_ASSOC);

    if ($etudiant) {
        return $etudiant;
    }

    error_log("Aucun particulier trouvé avec l'id : " . $idEtudiant);
    return [];
}

?>