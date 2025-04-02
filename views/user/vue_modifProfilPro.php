<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - HIJOBS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
    <div class="min-h-screen w-full">
        <?php include "./components/navbar.php" ?>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Modifier votre profil professionnel</h1>
                <a href="index.php?section=acc-off" 
                   class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Retour
                </a>
            </div>

            <div class="w-full">
                <form action="index.php?section=modifProfilPro" method="POST" class="space-y-4">
                    <?php foreach ($professionelle as $pro) { ?>
                        <input type="hidden" name="idEntreprise" value="<?php echo $pro['idEntreprise']; ?>">
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                                <input type="text" value="<?php echo $pro['NomEntreprise'] ?>" name="nomEntreprise" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Code Postal</label>
                                <input type="text" value="<?php echo $pro['CodePostal'] ?>" name="codePostal" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Ville</label>
                                <input type="text" value="<?php echo $pro['Ville'] ?>" name="ville" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Adresse</label>
                                <input type="text" value="<?php echo $pro['AdresseEntreprise'] ?>" name="AdresseEntreprise" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Pays</label>
                                <input type="text" value="<?php echo $pro['Pays'] ?>" name="pays" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="text" value="<?php echo $pro['TelephoneEntreprise'] ?>" name="telephoneEntreprise" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Site Web</label>
                                <input type="url" value="<?php echo $pro['SiteWeb'] ?>" name="siteWeb" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Email</label>
                                <input type="email" value="<?php echo $pro['EmailEntreprise'] ?>" name="emailEntreprise" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Numéro Siret</label>
                                <input type="text" value="<?php echo $pro['NumeroSiret'] ?>" name="NumeroSiret" required
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Secteur d'activité</label>
                                <select name="secteurActivite" id="secteurActivite"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <?php foreach ($ActiviteEntreprise as $act) { ?>
                                        <option value="<?php echo $act['intitAct']; ?>"><?php echo $act['intitAct']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Taille de l'entreprise</label>
                                <select name="Taille" id="Taille"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <?php foreach ($tailleEntreprise as $taille) { ?>
                                        <option value="<?php echo $taille['IntituleTaille']; ?>"><?php echo $taille['IntituleTaille']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="pt-6">
                        <button type="submit" 
                                class="w-full sm:w-auto inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

        .police-1 {
            font-family: "Bebas Neue", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .police-2 {
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</body>

</html>