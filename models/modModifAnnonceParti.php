<?php
function modifAnnonce() {
    global $connexion;

    if (!isset($_GET['numAnnonce'])) {
        return false;
    }

    $id = $_GET['numAnnonce'];

    if (!isset($_POST['titreAnnonce']) || !isset($_POST['intitEntreprise']) || !isset($_POST['localisation']) || !isset($_POST['typeContrat']) || !isset($_POST['descriptionAnnonce'])) {
        return false;
    }

    $titre = $_POST['titreAnnonce'];
    $entreprise = $_POST['intitEntreprise'];
    $localisation = $_POST['localisation'];
    $contrat = $_POST['typeContrat'];
    $description = $_POST['descriptionAnnonce'];

    try {
        $sqlAnnonce = "UPDATE annonces 
                       SET titreAnnonce = ?, villeAnnonces = ?, typeContrat = ?, descriptionAnnonce = ? 
                       WHERE numAnnonce = ?";
        $etatAnnonce = $connexion->prepare($sqlAnnonce);
        $resultAnnonce = $etatAnnonce->execute([$titre, $localisation, $contrat, $description, $id]);

        $sqlSelectEntreprise = "SELECT idEntreprise FROM annonces WHERE numAnnonce = ?";
        $etatSelect = $connexion->prepare($sqlSelectEntreprise);
        $etatSelect->execute([$id]);
        $idEntreprise = $etatSelect->fetchColumn();

        if ($idEntreprise) {
            $sqlEntreprise = "UPDATE entreprise SET NomEntreprise = ? WHERE idEntreprise = ?";
            $etatEntreprise = $connexion->prepare($sqlEntreprise);
            $resultEntreprise = $etatEntreprise->execute([$entreprise, $idEntreprise]);
        }
        
        return $resultAnnonce && ($resultEntreprise ?? true);
    } catch (PDOException $e) {
        return false;
    }
}
