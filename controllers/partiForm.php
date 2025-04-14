<?php
// Controller qui permet de récupérer les activités d'un particulier
include_once('models/modGetActiviteParti.php');

// Récupère les activités d'un particulier
$activiteParti = getActiviteParti($connexion);

include_once('views/user/vue_particulierForm.php');
