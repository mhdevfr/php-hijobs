<?php

include_once('models/ModSelectActivite.php');

$activites = afficher_activite();

?>
<option value="">Choisissez une activité</option>
<h1>Activités</h1>
<?php
foreach ($activites as $activite) {
    echo "<option value='" . $activite['id'] . "'>" . $activite['nom'] . "</option>";
}
?>