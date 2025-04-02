<?php
function getAnnoncesParti() {
    global $connexion;

    $requeteSql = "SELECT * FROM annonceparticulier";
    $etat = $connexion->prepare($requeteSql);
    $etat -> execute();
    $annonces = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $annonces;
};

function detailAnnonceParti($numAnnonce)
{
    global $connexion;
    $req = $connexion->prepare("SELECT * FROM annonceparticulier where numAnnonceParti= ?");
	$req->execute([$numAnnonce]);
    $annonce = $req->fetch(PDO::FETCH_ASSOC);
    return $annonce;
}

function deleteAnnonceParti($numAnnonce)
{
    global $connexion;
    $req = $connexion->prepare("DELETE FROM annonceparticulier where numAnnonceParti= ?");
    $req->execute([$numAnnonce]);
}
?>