<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="assets/css/shadcn-theme.css" />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-8">
        <!-- Section pour poster une annonce -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden mb-8 lg:mb-0">
            <div class="p-6">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">
                    Postez une annonce
                </h1>

                <!-- Formulaire pour poster une annonce -->
                <form action="index.php?section=addAnnonceParti" method="post" class="space-y-4">
                    <div class="space-y-4">
                        <!-- Champ pour le titre de l'annonce -->
                        <div>
                            <label for="titreAnnonce" class="block text-sm font-medium text-gray-700">
                                Titre de l'annonce
                            </label>
                            <input type="text"
                                id="titreAnnonce"
                                required
                                name="titreAnnonce"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                placeholder="Titre"
                                required>
                        </div>

                        <!-- Champ pour la localisation -->
                        <div>
                            <label for="localisation" class="block text-sm font-medium text-gray-700">
                                Localisation
                            </label>
                            <input type="text"
                                id="localisation"
                                name="localisation"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                placeholder="Localisation"
                                required>
                        </div>

                        <!-- Champs pour le nom et le prénom -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="NomParti" class="block text-sm font-medium text-gray-700">
                                    Nom
                                </label>
                                <input type="text"
                                    id="NomParti"
                                    name="NomParti"
                                    class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                    value="<?php echo $_SESSION['nomUser']; ?>"
                                    required>
                            </div>

                            <div>
                                <label for="PrenomParti" class="block text-sm font-medium text-gray-700">
                                    Prénom
                                </label>
                                <input type="text"
                                    id="PrenomParti"
                                    name="PrenomParti"
                                    class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                    value="<?php echo $_SESSION['prenomUser']; ?>"
                                    required>
                            </div>
                        </div>

                        <!-- Champ pour la description -->
                        <div>
                            <label for="descriptionAnnonce" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea id="descriptionAnnonce"
                                name="descriptionAnnonce"
                                rows="4"
                                required
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm resize-none"
                                placeholder="Description détaillée de votre annonce"
                                required></textarea>
                        </div>
                    </div>

                    <!-- Bouton pour soumettre l'annonce -->
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Publier l'annonce
                    </button>
                </form>
            </div>
        </div>

        <!-- Section pour les informations du profil -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                    Information du profil
                </h2>

                <?php foreach ($particulier as $parti): ?>
                    <div class="space-y-4">
                        <!-- Informations personnelles -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-gray-500">Nom</p>
                                <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['NomParti']); ?></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-gray-500">Prénom</p>
                                <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['PrenomParti']); ?></p>
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Adresse</p>
                            <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['AdresseParti']); ?></p>
                        </div>

                        <!-- Code postal et ville -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-gray-500">Code postal</p>
                                <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['CodePostalParti']); ?></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-gray-500">Ville</p>
                                <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['Ville']); ?></p>
                            </div>
                        </div>

                        <!-- Autres informations -->
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Pays</p>
                            <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['Pays']); ?></p>
                        </div>

                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Téléphone</p>
                            <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['Telephone']); ?></p>
                        </div>

                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Site web</p>
                            <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['SiteWeb']); ?></p>
                        </div>

                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">E-mail</p>
                            <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['Email']); ?></p>
                        </div>

                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Type de mission</p>
                            <p class="text-sm text-gray-900"><?php echo htmlspecialchars($parti['TypeMission']); ?></p>
                        </div>

                        <!-- Boutons pour modifier ou supprimer le profil -->
                        <div class="flex space-x-4 pt-4">
                            <a href="index.php?section=formModifProfil"
                                class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                Modifier le profil
                            </a>
                            <a href="index.php?section=formSupprProfil"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')"
                                class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                Supprimer le profil
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Section pour les annonces publiées -->
    <div class="mt-8 bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">
                    Annonces publiées
                </h2>
                <a href="index.php?section=annoncePoste"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Voir toutes les annonces
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Style pour désactiver le redimensionnement de la zone de texte -->
<style>
    textarea {
        resize: none;
    }
</style>