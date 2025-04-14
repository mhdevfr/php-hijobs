<?php 
// Modèle pour obtenir les activités
function getActivite($connexion) {

    $sql = "SELECT * FROM activite";

    $req = $connexion->prepare($sql);
    $req->execute();
    return $req->fetchAll();
}