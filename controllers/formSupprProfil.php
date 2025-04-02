<?php

include_once('models/modSupprProfil.php');

$idParticulier = $_SESSION['idParti'];

supprProfil($idParticulier);



include_once('controllers/logout.php');
