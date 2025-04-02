<?php
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

function afficher_entreprise() {
    global $connexion;

    $etat = $connexion->prepare("SELECT * FROM professionelle");
    $etat->execute();
    $entreprises = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $entreprises;
}

function detailEntreprise($id) {
    global $connexion;

    if (!is_numeric($id)) {
        return null;
    }

    $req = $connexion->prepare("SELECT * FROM professionelle WHERE idEntreprise = ?");
    $req->execute([$id]);
    return $req->fetch(PDO::FETCH_ASSOC);
}