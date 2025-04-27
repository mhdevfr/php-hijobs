<?php
// Modèle pour gérer les annonces de particulier
// Fonction pour obtenir une annonce de particulier
function getAnnoncesParti() {
    global $connexion;

    $requeteSql = "SELECT * FROM annonceparticulier ORDER BY created_at DESC";
    $etat = $connexion->prepare($requeteSql);
    $etat -> execute();
    $annonces = $etat->fetchAll(PDO::FETCH_ASSOC);
    return $annonces;
};

// Fonction qui permet d'obtenir les détail d'une annonce de particulier
function detailAnnonceParti($numAnnonce)
{
    global $connexion;
    
    $req = $connexion->prepare("
        SELECT a.*, p.NomParti, p.PrenomParti 
        FROM annonceparticulier a
        JOIN particulier p ON a.idParti = p.idParti
        WHERE a.numAnnonceParti = ?");
        
	$req->execute([$numAnnonce]);
    $annonce = $req->fetch(PDO::FETCH_ASSOC);
    return $annonce;
}

// Fontion qui permet de supprimer une annonce de particulier
function deleteAnnonceParti($numAnnonce)
{
    global $connexion;
    $req = $connexion->prepare("DELETE FROM annonceparticulier where numAnnonceParti= ?");
    $req->execute([$numAnnonce]);
}
?>