<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - HIJOBS</title>
    <link href="/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="h-full w-screen mt-4 flex items-center justify-center bg-gray-50 text-gray-950">
    <form action="index.php?section=registerProForm" method="post" class="w-full max-w-5xl rounded-xl bg-gray-950 p-8">
        <div class="text-center mb-8 text-gray-50">
            <a href="index.php?section=choixForm"
                class="inline-block bg-yellow-500 border-2 border-yellow-500 my-6 rounded py-1 px-2">Retour</a>

            <h1 class="text-2xl police-1 underline underline-offset-4 decoration-yellow-400 mb-4">Passer à un profil
                entreprise</h1>
            <p class="police-2 italic text-sm text-center">Vous êtes sur le point de passer à un profil professionnel.
                Veuillez remplir les
                champs suivants pour continuer.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col items-center">
                <p class="police-1 text-gray-50">Identifiant de connexion</p>
                <input type="text" placeholder="Nom de l'entreprise" class="w-4/5 p-2 m-2 rounded-lg"
                    name="nomEntreprise" required>
                <input type="text" placeholder="E-mail entreprise" class="w-4/5 p-2 m-2 rounded-lg"
                    name="mailEntreprise">
                <input type="password" placeholder="votremotdepasse" name="password" class="w-4/5 p-2 m-2 rounded-lg"
                    required>
                <input type="password" placeholder="confirmezvotremotdepasse" name="passwordConf"
                    class="w-4/5 p-2 m-2 rounded-lg" required>
            </div>
            <div class="flex flex-col items-center">
                <h1 class="police-1 text-gray-50">Information de l'entreprise</h1>


                <input type="text" placeholder="Code postal" class="w-4/5 p-2 m-2 rounded-lg"
                    name="codePostalEntreprise" required>
                <input type="text" placeholder="Ville" class="w-4/5 p-2 m-2 rounded-lg" name="villeEntreprise" required>

                <input type="text" placeholder="Adresse de l'entreprise" class="w-4/5 p-2 m-2 rounded-lg"
                    name="adresseEntreprise" required>
                <input type="text" placeholder="Pays" class="w-4/5 p-2 m-2 rounded-lg" name="paysEntreprise" required>
                <input type="text" placeholder="Téléphone entreprise" class="w-4/5 p-2 m-2 rounded-lg"
                    name="telephoneEntreprise" required>
                <input type="text" placeholder="Site web (facultatif)" class="w-4/5 p-2 m-2 rounded-lg"
                    name="siteWebEntreprise">

                <input type="text" placeholder="N°SIRET" class="w-4/5 p-2 m-2 rounded-lg" name="siret" required>
                <select name="secteurActivite" id="secteurActivite" class="w-4/5 p-2 m-2 rounded-lg">
                    <?php
                    foreach ($activite as $act) { ?>
                        <option value="<?php echo $act['intitAct']; ?>"><?php echo $act['intitAct']; ?></option>
                    <?php } ?>
                </select>

                <select name="tailleEntreprise" id="tailleEntreprise" class="w-4/5 p-2 m-2 rounded-lg">
                    <?php
                    foreach ($tailleEntreprise as $taille) { ?>
                        <option value="<?php echo $taille['IntituleTaille']; ?>"><?php echo $taille['IntituleTaille']; ?>
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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function (e) {
            submitButton.disabled = true;
            submitButton.value = 'Inscription en cours...';
            setTimeout(function () {
                submitButton.disabled = false;
                submitButton.value = 'Postuler';
            }, 5000);
        });
    });
</script>

</html>