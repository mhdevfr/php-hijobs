<?php
// Modèle pour afficher les entreprises
function afficher_entreprise() {
    global $connexion;

    $etat = $connexion->prepare("SELECT * FROM professionelle");
    $etat->execute();
    $entreprises = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $entreprises;
}