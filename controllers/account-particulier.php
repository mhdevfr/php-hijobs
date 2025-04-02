<?php

include_once('models/modParticulier.php');


$idParticulier = $_SESSION['idParti'];



$particulier = get_particulier($idParticulier);









include_once('views/vue_particulier.php');
?>
