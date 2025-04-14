<?php

// Inclusion du modèle pour récupérer les activités
include_once('models/ModSelectActivite.php');

// Récupération des activités depuis la base de données
$activites = afficher_activite();

?>

<!-- Option par défaut -->
<option value="">Choisissez une activité</option>

<!-- Titre de la section -->
<h1>Activités</h1>
<?php

// Boucle pour afficher chaque activité sous forme d'option
foreach ($activites as $activite) {
    echo "<option value='" . $activite['id'] . "'>" . $activite['nom'] . "</option>";
}
?>