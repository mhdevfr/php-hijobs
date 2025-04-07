<?php

require_once('./models/modModifProfilPro.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Log des données reçues
        error_log("Données POST reçues: " . print_r($_POST, true));
        
        // Vérification de la session
        if (!isset($_SESSION['idEntreprise'])) {
            throw new Exception("Session expirée ou non connecté");
        }

        // Vérification des champs requis
        $required_fields = ['idEntreprise', 'nomEntreprise', 'codePostal', 'ville', 'AdresseEntreprise', 
                          'pays', 'telephoneEntreprise', 'emailEntreprise', 'NumeroSiret', 'secteurActivite'];
        
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                throw new Exception("Le champ $field est requis");
            }
        }

        $result = modifProfilPro(
            $_POST['idEntreprise'],
            $_POST['nomEntreprise'],
            $_POST['codePostal'],
            $_POST['ville'],
            $_POST['AdresseEntreprise'],
            $_POST['pays'],
            $_POST['telephoneEntreprise'],
            $_POST['siteWeb'] ?? '',  // Optionnel
            $_POST['emailEntreprise'],
            $_POST['NumeroSiret'],
            $_POST['secteurActivite']
        );

        $_SESSION['success'] = "Profil mis à jour avec succès";
        header('Location: index.php?section=acc-off');
        exit;

    } catch (Exception $e) {
        error_log("Erreur lors de la modification du profil: " . $e->getMessage());
        $_SESSION['error'] = "Erreur: " . $e->getMessage();
        header('Location: index.php?section=formModifProfilPro');
        exit;
    }
}