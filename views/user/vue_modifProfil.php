<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - HIJOBS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
    <div class="min-h-screen flex items-center  flex-col w-full">
        <?php include "./components/navbar.php" ?>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 py-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Modifier votre profil</h1>
                <a href="index.php?section=acc-parti"
                    class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Retour
                </a>
            </div>

            <div class="w-full">
                <form action="index.php?section=modifProfil" method="POST" class="space-y-4">
                    <?php foreach ($particulier as $parti) { ?>
                        <input type="hidden" name="idParti" value="<?php echo $parti['idParti']; ?>">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Nom</label>
                                <input required
                                    type="text"
                                    value="<?php echo $parti['NomParti'] ?>"
                                    name="nomParti"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Prénom</label>
                                <input required
                                    type="text"
                                    value="<?php echo $parti['PrenomParti'] ?>"
                                    name="prenomParti"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Adresse</label>
                                <input required
                                    type="text"
                                    value="<?php echo $parti['AdresseParti'] ?>"
                                    name="adresseParti"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Code Postal</label>
                                <input required
                                    type="text"
                                    value="<?php echo $parti['CodePostalParti'] ?>"
                                    name="codePostalParti"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Ville</label>
                                <input required
                                    type="text"
                                    value="<?php echo $parti['Ville'] ?>"
                                    name="ville"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Pays</label>
                                <input required
                                    type="text"
                                    value="<?php echo $parti['Pays'] ?>"
                                    name="pays"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Téléphone</label>
                                <input required
                                    type="text"
                                    value="<?php echo $parti['Telephone'] ?>"
                                    name="telephone"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Site Web</label>
                                <input
                                    type="text"
                                    value="<?php echo $parti['SiteWeb'] ?>"
                                    name="siteWeb"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Email</label>
                                <input required
                                    type="email"
                                    value="<?php echo $parti['Email'] ?>"
                                    name="email"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Type de mission</label>
                                <select name="typeMission"
                                    id="typeMission"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <?php foreach ($mission as $missions) { ?>
                                        <option value="<?php echo $missions['IntituleParti']; ?>">
                                            <?php echo $missions['IntituleParti']; ?>
                                        </option>
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