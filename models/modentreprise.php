<?php
// Modèle pour gérer les entreprises
// Fonction qui permet d'obtenir toutes les entreprises
function get_entreprises($intitEntreprise) {
    global $connexion;

    $req = $connexion->prepare("SELECT idEntreprise FROM professionelle WHERE nomEntreprise = ?");
    $req->execute([$intitEntreprise]);
    $pro = $req->fetch(PDO::FETCH_ASSOC);

    if ($pro) {
        return $pro['idEntreprise'];
    }
    
    error_log("Aucun particulier trouvé avec le nom: $intitEntreprise");
    return null;
}

// Fonction qui permet d'afficher les entrepries
function afficher_entreprise() {
    global $connexion;

    $etat = $connexion->prepare("SELECT * FROM professionelle");
    $etat->execute();
    $entreprises = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $entreprises;
}

// Fonction qui perrmet d'obtenir les détails d'une entreprise
function detailEntreprise($id) {
    global $connexion;

    if (!is_numeric($id)) {
        return null;
    }

    $req = $connexion->prepare("SELECT * FROM professionelle WHERE idEntreprise = ?");
    $req->execute([$id]);
    return $req->fetch(PDO::FETCH_ASSOC);
}