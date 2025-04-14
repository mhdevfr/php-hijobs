<?php
// Modèle pour afficher les types de contrats
function afficher_contrats() {
    global $connexion;
    $etat = $connexion->prepare("SELECT * FROM types_contrats");
    $etat->execute();
    $contrats = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $contrats;
}

?>