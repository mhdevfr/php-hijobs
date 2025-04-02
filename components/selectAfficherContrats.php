<?php
include_once '../models/modAfficherContrats.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <select>
        <?php 
        $contrats = array("CDI", "CDD", "Stage", "Alternance", "Freelance", "Intérim");
        foreach($contrats as $contrat){
            echo "<option value='$contrat'>$contrat</option>";
        }
        ?>
    </select>
</body>
</html>