<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - HIJOBS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center w-full">
        <?php include "./components/navbar.php" ?>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gray-950 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold text-white flex items-center gap-2">
                            <i class="fas fa-building"></i>
                            Modifier votre profil professionnel
                        </h1>
                        <a href="index.php?section=acc-off" 
                           class="inline-flex items-center justify-center rounded-md bg-gray-50 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            <?php 
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?section=modifProfilPro" method="POST" class="space-y-6">
                        <?php foreach ($professionelle as $pro) { ?>
                            <input type="hidden" name="idEntreprise" value="<?php echo $pro['idEntreprise']; ?>">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                            <i class="fas fa-building text-gray-400"></i>
                                            Nom de l'entreprise
                                        </label>
                                        <input type="text" value="<?php echo $pro['NomEntreprise'] ?>" name="nomEntreprise" required
                                               class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all">
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                            <i class="fas fa-location-dot text-gray-400"></i>
                                            Adresse complète
                                        </label>
                                        <input type="text" value="<?php echo $pro['AdresseEntreprise'] ?>" name="AdresseEntreprise" required
                                               class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                        <div class="grid grid-cols-2 gap-4 mt-2">
                                            <input type="text" value="<?php echo $pro['CodePostal'] ?>" name="codePostal" placeholder="Code Postal" required
                                                   class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                            <input type="text" value="<?php echo $pro['Ville'] ?>" name="ville" placeholder="Ville" required
                                                   class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                        </div>
                                        <input type="text" value="<?php echo $pro['Pays'] ?>" name="pays" placeholder="Pays" required
                                               class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                            <i class="fas fa-address-card text-gray-400"></i>
                                            Informations de contact
                                        </label>
                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <span class="bg-gray-100 p-2 rounded-l-lg border border-r-0 border-gray-200">
                                                    <i class="fas fa-phone text-gray-400"></i>
                                                </span>
                                                <input type="text" value="<?php echo $pro['TelephoneEntreprise'] ?>" name="telephoneEntreprise" required
                                                       class="flex-1 px-3 py-2 rounded-r-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                            </div>
                                            <div class="flex items-center">
                                                <span class="bg-gray-100 p-2 rounded-l-lg border border-r-0 border-gray-200">
                                                    <i class="fas fa-envelope text-gray-400"></i>
                                                </span>
                                                <input type="email" value="<?php echo $pro['EmailEntreprise'] ?>" name="emailEntreprise" required
                                                       class="flex-1 px-3 py-2 rounded-r-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                            </div>
                                            <div class="flex items-center">
                                                <span class="bg-gray-100 p-2 rounded-l-lg border border-r-0 border-gray-200">
                                                    <i class="fas fa-globe text-gray-400"></i>
                                                </span>
                                                <input type="url" value="<?php echo $pro['SiteWeb'] ?>" name="siteWeb" 
                                                       class="flex-1 px-3 py-2 rounded-r-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                            <i class="fas fa-briefcase text-gray-400"></i>
                                            Informations légales
                                        </label>
                                        <input type="text" value="<?php echo $pro['NumeroSiret'] ?>" name="NumeroSiret" placeholder="Numéro SIRET" required
                                               class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>

                            <!-- Sélecteurs -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                        <i class="fas fa-industry text-gray-400"></i>
                                        Secteur d'activité
                                    </label>
                                    <select name="secteurActivite" id="secteurActivite"
                                            class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                        <?php foreach ($ActiviteEntreprise as $act) { ?>
                                            <option value="<?php echo $act['intitAct']; ?>"><?php echo $act['intitAct']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                        <i class="fas fa-users text-gray-400"></i>
                                        Taille de l'entreprise
                                    </label>
                                   <input type="number" value="<?php echo $pro['TailleEntreprise'] ?>" name="TailleEntreprise" placeholder="Taille de l'entreprise" required
                                           class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                </div> -->
                            </div>
                        <?php } ?>

                        <div class="pt-6 flex justify-end">
                            <button type="submit" 
                                    class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-6 py-3 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        input, select {
            transition: all 0.2s ease-in-out;
        }

        input:focus, select:focus {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .bg-gradient-to-r {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</body>

</html>