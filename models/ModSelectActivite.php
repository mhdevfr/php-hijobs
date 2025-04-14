<?php
// Permet de d'afficher les activités
function afficher_activite() {
    global $connexion;
    $etat = $connexion->prepare("SELECT * FROM activite");
    $etat->execute();
    $activites = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $activites;
}

?>