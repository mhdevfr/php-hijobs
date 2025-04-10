<?php 

include_once('models/modGetTaille.php');
include_once('models/modGetActivite.php');


// $tailleEntreprise = getTaille($connexion);
$activite = getActivite($connexion);

include_once('views/user/vue_proForm.php');

?>