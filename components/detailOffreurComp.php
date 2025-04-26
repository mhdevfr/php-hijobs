<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="assets/css/shadcn-theme.css" />

<!-- Conteneur principal -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- En-tête avec le titre et le bouton de retour -->
    <div class="flex justify-between lg:flex-row flex-col items-center mb-8">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Toutes les annonces publiées</h1>
        <a href="<?php echo isset($_SESSION['idParti']) ? 'index.php?section=acc-parti' : 'index.php?section=acc-off'; ?>"
            class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 ml-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            Retour
        </a>
    </div>

    <!-- Vérifie si des annonces sont disponibles -->
    <?php if (!empty($annoncePoste)): ?>
        <div class="space-y-6">
            <?php foreach ($annoncePoste as $poste):
                // Vérifie si l'utilisateur est une entreprise ou un particulier
                $isEntreprise = isset($_SESSION['idEntreprise']);
                $isParti = isset($_SESSION['idParti']);

                // Affiche uniquement les annonces correspondant à l'utilisateur connecté
                if (($isEntreprise && $poste['idEntreprise'] == $_SESSION['idEntreprise']) ||
                    ($isParti && $poste['idParti'] == $_SESSION['idParti'])
                ): ?>

                    <!-- Carte d'annonce -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="p-6">
                            <div class="space-y-4">
                                <!-- Titre et nom de l'entreprise ou du particulier -->
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900">
                                        <?php echo $isEntreprise ?
                                            htmlspecialchars($poste['titreAnnoncePro'] ?? '') :
                                            htmlspecialchars($poste['titreAnnonce'] ?? ''); ?>
                                    </h2>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <?php echo $isEntreprise ?
                                            htmlspecialchars($poste['NomEntreprise'] ?? '') :
                                            htmlspecialchars(($poste['NomParti'] ?? '') . ' ' . ($poste['PrenomParti'] ?? '')); ?>
                                    </p>
                                </div>

                                <!-- Description de l'annonce -->
                                <div class="text-sm text-gray-700">
                                    <?php echo $isEntreprise ?
                                        htmlspecialchars($poste['descAnnoncePro'] ?? '') :
                                        htmlspecialchars($poste['descriptionParti'] ?? ''); ?>
                                </div>

                                <!-- Type de contrat (uniquement pour les entreprises) -->
                                <?php if ($isEntreprise): ?>
                                    <div class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-800">
                                        <?php echo htmlspecialchars($poste['typeContrat']); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Ville de l'annonce -->
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>
                                        <?php echo $isEntreprise ?
                                            htmlspecialchars($poste['villeAnnoncePro'] ?? '') :
                                            htmlspecialchars($poste['villeAnnonceParti'] ?? ''); ?>
                                    </span>
                                </div>

                                <!-- Date de création de l'annonce -->
                                <div class="text-sm text-gray-500">
                                    Créé le <?php echo htmlspecialchars($poste['created_at'] ?? ''); ?>
                                </div>

                                <!-- Boutons pour modifier ou supprimer l'annonce -->
                                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                    <!-- Bouton pour modifier l'annonce -->
                                    <a href="index.php?section=formModifAnnonce&idAnnonce=<?php echo $isEntreprise ?
                                                                                                $poste['numAnnoncePro'] : $poste['numAnnonceParti']; ?>"
                                        class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                        Modifier l'annonce
                                    </a>

                                    <!-- Formulaire pour supprimer l'annonce -->
                                    <form method="POST" action="index.php?section=supprimerAnnonce" class="inline">
                                        <input type="hidden" name="numAnnonce"
                                            value="<?php echo $isEntreprise ? $poste['numAnnoncePro'] : $poste['numAnnonceParti']; ?>">
                                        <button type="submit"
                                            name="supprimer"
                                            class="inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 w-full sm:w-auto">
                                            Supprimer l'annonce
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php endif;
            endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Message si aucune annonce n'est disponible -->
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Aucune annonce publiée.</p>
        </div>
    <?php endif; ?>
</div>