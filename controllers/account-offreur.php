<?php
include_once('models/modProfesionnelle.php');
include_once('models/modTypeContrat.php');

$idProfessionelle = $_SESSION['idEntreprise'];

$professionelle = get_profesionnelle($idProfessionelle);

$typedecontrat = get_type_de_contrat();


include_once('views/vue_offreur.php');
?>
