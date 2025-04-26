<?php
// Modèle pour gérer les annonces de professionnel
// Fonction pour obtenir toutes les annonces de professionnel
function getAnnoncesPro() {
    global $connexion;

    $requeteSql = "SELECT * FROM annoncepro";
    $etat = $connexion->prepare($requeteSql);
    $etat -> execute();
    $annonces = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $annonces;
}

// Fonction qui permet d'obtenir les détail d'une annonce de professionnel
function detailAnnoncePro($numAnnonce)
{
    global $connexion;
    
    $req = $connexion->prepare("
        SELECT a.*, p.NomEntreprise 
        FROM annoncepro a
        JOIN professionelle p ON a.idEntreprise = p.idEntreprise
        WHERE a.numAnnoncePro = ?");
        
	$req->execute([$numAnnonce]);
    $annonce = $req->fetch(PDO::FETCH_ASSOC);
    return $annonce;
}
?>