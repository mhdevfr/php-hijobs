<?php

function annoncePoste($connexion)
{
    $proId = $_SESSION['idEntreprise'] ?? null;
    $partiId = $_SESSION['idParti'] ?? null;

    if (!$proId && !$partiId) {
        return [];
    }

    try {
        if ($proId) {
            $sql = "SELECT a.*, p.NomEntreprise 
                    FROM annoncepro a
                    LEFT JOIN professionelle p ON a.idEntreprise = p.idEntreprise
                    WHERE a.idEntreprise = :id";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':id', $proId, PDO::PARAM_INT);
        } else {
            $sql = "SELECT a.*, p.NomParti, p.PrenomParti
                    FROM annonceparticulier a
                    LEFT JOIN particulier p ON a.idParti = p.idParti
                    WHERE a.idParti = :id";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':id', $partiId, PDO::PARAM_INT);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return $result;
    } catch (PDOException $e) {
        error_log("Erreur dans annoncePoste: " . $e->getMessage());
        return [];
    }
}



