<?php
// Modèle pour modifier une annonce
// Modifie une annonce selon une entreprise ou un particulier
function modifAnnonce($connexion, $titreAnnonce, $villeAnnonce, $description, $typeContrat, $numAnnoncePro, $numAnnonceParti)
{

    $proId = $_SESSION['idEntreprise'] ?? null;
    $partiId = $_SESSION['idParti'] ?? null;

    if (!$proId && !$partiId) {
        return [];
    }

    try {
        if ($proId) {
            $sql = "UPDATE annoncepro SET
            titreAnnoncePro = :titreAnnoncePro,
            descAnnoncePro = :descriptionPro,
            villeAnnoncePro = :villeAnnoncePro,
            typeContrat = :typeContrat
            WHERE numAnnoncePro = :numAnnoncePro";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':titreAnnoncePro', $titreAnnonce, PDO::PARAM_STR);
            $stmt->bindParam(':descriptionPro', $description, PDO::PARAM_STR);
            $stmt->bindParam(':villeAnnoncePro', $villeAnnonce, PDO::PARAM_STR);
            $stmt->bindParam(':typeContrat', $typeContrat, PDO::PARAM_STR);
            $stmt->bindParam(':numAnnoncePro', $numAnnoncePro, PDO::PARAM_INT);
        } else {
            $sql = "UPDATE annonceparticulier SET
            titreAnnonce = :titreAnnonceParti,
            villeAnnonceParti = :villeAnnonceParti,
            descriptionParti = :descriptionParti
            WHERE numAnnonceParti = :numAnnonceParti";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':titreAnnonceParti', $titreAnnonce, PDO::PARAM_STR);
            $stmt->bindParam(':villeAnnonceParti', $villeAnnonce, PDO::PARAM_STR);
            $stmt->bindParam(':descriptionParti', $description, PDO::PARAM_STR);
            $stmt->bindParam(':numAnnonceParti', $numAnnonceParti, PDO::PARAM_INT);
        }
        return $stmt->execute();
        
    } catch (PDOException $e) {
        error_log("Erreur dans modifAnnonce: " . $e->getMessage());
        return false;
    }
}
