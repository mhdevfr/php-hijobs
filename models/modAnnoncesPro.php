<?php
function getAnnoncesPro() {
    global $connexion;

    $requeteSql = "SELECT * FROM annoncepro";
    $etat = $connexion->prepare($requeteSql);
    $etat -> execute();
    $annonces = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $annonces;
}

function detailAnnoncePro($numAnnonce)
{
    global $connexion;
    $req = $connexion->prepare("SELECT * FROM annoncepro where numAnnoncePro=?");
	$req->execute([$numAnnonce]);
    $annonce = $req->fetch(PDO::FETCH_ASSOC);
    return $annonce;
}
?>