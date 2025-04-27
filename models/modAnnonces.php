<?php
// Modèle pour gérer les annonces
function getAnnonces() {
    global $connexion;
    
    try {
        $requeteSql = "SELECT *, 'particulier' as type_annonce,
                      CONCAT(NomParti, ' ', PrenomParti) AS nom_complet
                      FROM annonceparticulier
                      JOIN particulier ON annonceparticulier.idParti = particulier.idParti
                      ORDER BY annonceparticulier.created_at DESC";
        $etat = $connexion->prepare($requeteSql);
        $etat->execute();
        $annoncesParticulier = $etat->fetchAll(PDO::FETCH_ASSOC);
        
        $requetesSql = "SELECT *, professionelle.nomEntreprise, 'professionnel' as type_annonce 
                       FROM annoncepro
                       JOIN professionelle ON annoncepro.idEntreprise = professionelle.idEntreprise
                       ORDER BY annoncepro.created_at DESC";
        $etats = $connexion->prepare($requetesSql);
        $etats->execute();
        $annoncesPro = $etats->fetchAll(PDO::FETCH_ASSOC);
        
        // Fusionner les deux tableaux puis les trier par date
        $toutesAnnonces = array_merge($annoncesParticulier, $annoncesPro);
        
        // Tri final pour s'assurer que toutes les annonces sont bien triées par date
        usort($toutesAnnonces, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        
        return $toutesAnnonces;
        
    } catch(PDOException $e) {
        error_log("Erreur dans getAnnonces: " . $e->getMessage());
        return [];
    }
}