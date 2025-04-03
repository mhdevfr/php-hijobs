<?php

include_once('models/modSupprProfil.php');

$userType = $_SESSION['userType'];
supprProfil($idParticulier, $userType);



include_once('controllers/logout.php');
