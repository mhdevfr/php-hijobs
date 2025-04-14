<?php
// Controller qui gère la déconnexion de l'utilisateur
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit();
