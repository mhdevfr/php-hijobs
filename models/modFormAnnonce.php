<?php
function getOffreur($connexion, $numAnnonce)
{
    $proId = $_SESSION['idEntreprise'] ?? null;
    $partiId = $_SESSION['idParti'] ?? null;

    if (!$proId && !$partiId) {
        return [];
    }

    try {
        if ($proId) {
            $sqls = "SELECT * FROM annoncepro JOIN professionelle 
            ON annoncepro.idEntreprise = professionelle.idEntreprise
            WHERE professionelle.idEntreprise = :idEntreprise
            AND annoncepro.numAnnoncePro = :numAnnonce";
            
            $req = $connexion->prepare($sqls);
            $req->bindParam(':idEntreprise', $proId, PDO::PARAM_STR);
            $req->bindParam(':numAnnonce', $numAnnonce, PDO::PARAM_STR);
        } else {
            $sql = "SELECT * FROM annonceparticulier JOIN particulier 
            ON annonceparticulier.idParti = particulier.idParti
            WHERE particulier.idParti = :idParticulier
            AND annonceparticulier.numAnnonceParti = :numAnnonce";
            
            $req = $connexion->prepare($sql);
            $req->bindParam(':idParticulier', $partiId, PDO::PARAM_STR);
            $req->bindParam(':numAnnonce', $numAnnonce, PDO::PARAM_STR);
        }
        $req->execute();
        $annonceModif = $req->fetchAll(PDO::FETCH_ASSOC);

        return $annonceModif;
    } catch (PDOException $e) {
        error_log("Erreur dans annoncePoste: " . $e->getMessage());
        return [];
    }
}