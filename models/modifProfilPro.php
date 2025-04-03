<?php
session_start();
require_once('./models/modModifProfilPro.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log pour le debug
    error_log("POST reçu dans modifProfilPro.php");
    error_log("POST data: " . print_r($_POST, true));

    // Validation des données
    if (!isset($_POST['idEntreprise'])) {
        $_SESSION['error'] = "ID de l'entreprise manquant";
        error_log("Erreur: ID entreprise manquant");
        header('Location: index.php?section=modifProfilPro');
        exit;
    }

    // Récupération des données du formulaire avec nettoyage
    $idEntreprise = filter_var($_POST['idEntreprise'], FILTER_SANITIZE_NUMBER_INT);
    $NomEntreprise = filter_var($_POST['nomEntreprise'], FILTER_SANITIZE_STRING);
    $CodePostalPro = filter_var($_POST['codePostal'], FILTER_SANITIZE_STRING);
    $Ville = filter_var($_POST['ville'], FILTER_SANITIZE_STRING);
    $AdresseEntreprise = filter_var($_POST['AdresseEntreprise'], FILTER_SANITIZE_STRING);
    $Pays = filter_var($_POST['pays'], FILTER_SANITIZE_STRING);
    $TelephoneEntreprise = filter_var($_POST['telephoneEntreprise'], FILTER_SANITIZE_STRING);
    $siteweb = filter_var($_POST['siteWeb'], FILTER_SANITIZE_URL);
    $EmailEntreprise = filter_var($_POST['emailEntreprise'], FILTER_SANITIZE_EMAIL);
    $NumeroSiret = filter_var($_POST['NumeroSiret'], FILTER_SANITIZE_STRING);
    $SecteurActivite = filter_var($_POST['secteurActivite'], FILTER_SANITIZE_STRING);
    $Taille = filter_var($_POST['Taille'], FILTER_SANITIZE_STRING);

    // Log des données nettoyées
    error_log("Données nettoyées: " . print_r([
        'idEntreprise' => $idEntreprise,
        'NomEntreprise' => $NomEntreprise,
        'CodePostalPro' => $CodePostalPro,
        'Ville' => $Ville,
        'AdresseEntreprise' => $AdresseEntreprise,
        'Pays' => $Pays,
        'TelephoneEntreprise' => $TelephoneEntreprise,
        'siteweb' => $siteweb,
        'EmailEntreprise' => $EmailEntreprise,
        'NumeroSiret' => $NumeroSiret,
        'SecteurActivite' => $SecteurActivite,
        'Taille' => $Taille
    ], true));

    try {
        $result = modifProfilPro(
            $idEntreprise,
            $NomEntreprise,
            $CodePostalPro,
            $Ville,
            $AdresseEntreprise,
            $Pays,
            $TelephoneEntreprise,
            $siteweb,
            $EmailEntreprise,
            $NumeroSiret,
            $SecteurActivite,
            $Taille
        );

        error_log("Résultat de modifProfilPro: " . ($result ? "succès" : "échec"));

        if ($result) {
            $_SESSION['success'] = "Profil mis à jour avec succès";
            header('Location: index.php?section=acc-off');
            exit;
        } else {
            $_SESSION['error'] = "Erreur lors de la mise à jour du profil";
            header('Location: index.php?section=modifProfilPro');
            exit;
        }
    } catch (Exception $e) {
        error_log("Exception dans modifProfilPro: " . $e->getMessage());
        $_SESSION['error'] = "Une erreur est survenue : " . $e->getMessage();
        header('Location: index.php?section=modifProfilPro');
        exit;
    }
}