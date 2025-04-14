<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - HIJOBS</title>
    <link href="/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="h-full w-screen flex items-center justify-center bg-gray-50 text-gray-950">
    <form action="index.php?section=registerPartiForm" method="post"
        class="w-full mt-4 max-w-5xl rounded-xl bg-gray-950 p-8">
        <div class="text-center mb-8 text-gray-50">
            <a href="index.php?section=choixForm"
                class="inline-block bg-yellow-500 border-2 border-yellow-500 my-6 rounded py-1 px-2">Retour</a>

            <h1 class="text-2xl police-1 underline underline-offset-4 decoration-yellow-400 mb-4">Passer à un profil
                particulier</h1>
            <p class="police-2 italic text-sm text-center">Vous êtes sur le point de passer à un profil particulier.
                Veuillez remplir les
                champs suivants pour continuer.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="flex flex-col items-center">
                <p class="police-1 text-gray-50">Identifiant de connexion</p>
                <input type="text" placeholder="Nom" class="w-4/5 p-2 m-2 rounded-lg" name="nomParticulier" required>
                <input type="text" placeholder="Prénom" class="w-4/5 p-2 m-2 rounded-lg" name="prenomParticulier"
                    required>
                <input type="text" placeholder="E-mail" class="w-4/5 p-2 m-2 rounded-lg" name="mailParticulier">

                <input type="password" placeholder="votremotdepasse" name="password" class="w-4/5 p-2 m-2 rounded-lg"
                    required>
                <input type="password" placeholder="confirmezvotremotdepasse" name="passwordConf"
                    class="w-4/5 p-2 m-2 rounded-lg" required>
            </div>
            <div class="flex flex-col items-center">
                <h1 class="police-1 text-gray-50">Information complémentaire</h1>
                <input type="text" placeholder="Adresse" class="w-4/5 p-2 m-2 rounded-lg" name="adresseParticulier"
                    required>
                <input type="text" placeholder="Code postal" class="w-4/5 p-2 m-2 rounded-lg"
                    name="codePostalParticulier" required>
                <input type="text" placeholder="Ville" class="w-4/5 p-2 m-2 rounded-lg" name="villeParticulier"
                    required>
                <input type="text" placeholder="Pays" class="w-4/5 p-2 m-2 rounded-lg" name="paysParticulier" required>
                <input type="text" placeholder="Téléphone" class="w-4/5 p-2 m-2 rounded-lg" name="telephoneParticulier"
                    required>
                <input type="text" placeholder="Site web(facultatif)" class="w-4/5 p-2 m-2 rounded-lg"
                    name="siteWebParticulier">
                <p class="police-1 text-gray-50">Type de Mission : </p>
                <select name="mission" class="w-4/5 p-2 m-2 rounded-lg" id="">
                    <?php foreach ($activiteParti as $mission) { ?>
                        <option value="<?php echo $mission['IntituleParti']; ?>"><?php echo $mission['IntituleParti']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="flex flex-col items-center">
            <input id="submitButton" type="submit" value="S'inscrire"
                class="w-5/6 p-2 m-2 mb-2 bg-yellow-400 rounded-lg">
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function(e) {
            submitButton.disabled = true;
            submitButton.value = 'Inscription en cours...';
            setTimeout(function() {
                submitButton.disabled = false;
                submitButton.value = 'Postuler';
            }, 5000);
        });
    });
</script>

</html>