<?php 

include_once('models/modGetActiviteParti.php');

$activiteParti = getActiviteParti($connexion);

include_once('views/user/vue_particulierForm.php');

?>