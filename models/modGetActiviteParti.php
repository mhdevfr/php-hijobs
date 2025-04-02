<?php

function getActiviteParti($connexion) {

    $sql = "SELECT * FROM activiteparticulier";

    $req = $connexion->prepare($sql);
    $req->execute();
    return $req->fetchAll();
}