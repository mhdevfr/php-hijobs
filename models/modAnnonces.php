<?php
// Modèle pour gérer les annonces
function getAnnonces() {
    global $connexion;
    
    try {
        $requeteSql = "SELECT *, 'particulier' as type_annonce,
                      CONCAT(NomParti, ' ', PrenomParti) AS nom_complet
                      FROM annonceparticulier
                      JOIN particulier ON annonceparticulier.idParti = particulier.idParti";
        $etat = $connexion->prepare($requeteSql);
        $etat->execute();
        $annoncesParticulier = $etat->fetchAll(PDO::FETCH_ASSOC);
        
        $requetesSql = "SELECT *, professionelle.nomEntreprise, 'professionnel' as type_annonce 
                       FROM annoncepro
                       JOIN professionelle ON annoncepro.idEntreprise = professionelle.idEntreprise";
        $etats = $connexion->prepare($requetesSql);
        $etats->execute();
        $annoncesPro = $etats->fetchAll(PDO::FETCH_ASSOC);
        return array_merge($annoncesParticulier, $annoncesPro);
        
    } catch(PDOException $e) {
        error_log("Erreur dans getAnnonces: " . $e->getMessage());
        return [];
    }
}