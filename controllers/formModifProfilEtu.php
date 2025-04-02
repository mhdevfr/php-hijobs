<?php
include_once('models/modEtudiant.php');

$idEtudiant = $_SESSION['idEtudiant'];

$etudiant = get_etudiant($idEtudiant);

include_once('views/user/vue_modifProfilEtu.php');