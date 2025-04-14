<?php
// Modèle pour obtenir les tailles d'entreprise
function getTaille($connexion){
    $sql = "SELECT * FROM tailleentreprise";
    $req = $connexion->prepare($sql);
    $req->execute();
    return $req->fetchAll();
}