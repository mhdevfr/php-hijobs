<?php 

function get_type_de_contrat(){
    global $connexion;
    

    $sql = "SELECT * FROM typecontrat";
    $etat = $connexion->prepare($sql); 
    $etat->execute();
    $type_contrat = $etat->fetchAll(PDO::FETCH_ASSOC);

    return $type_contrat;
}