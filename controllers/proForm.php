<?php
// Controller qui permet de récupérer les activités d'une entreprise
include_once('models/modGetTaille.php');
include_once('models/modGetActivite.php');

// Récupère les activités d'une entreprise
// $tailleEntreprise = getTaille($connexion);
$activite = getActivite($connexion);

include_once('views/user/vue_proForm.php');
