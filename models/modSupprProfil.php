<?php

function supprProfil($idParticulier) {
    
    global $connexion;

    $stmt = $connexion-> prepare('DELETE FROM particulier WHERE idParti = ?');
    $stmt->execute([$idParticulier]);

    return $stmt->rowCount();
}
