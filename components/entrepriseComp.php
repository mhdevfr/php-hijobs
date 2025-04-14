<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Titre principal de la page -->
    <h2 class="text-2xl font-semibold text-gray-900 mb-8">
        Liste des entreprises
    </h2>

    <!-- Grille pour afficher les entreprises -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($entreprises as $entreprise): ?>
            <!-- Carte individuelle pour chaque entreprise -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300">
                <div class="block p-6">
                    <div class="flex flex-col items-center">
                        <!-- Logo de l'entreprise -->
                        <div class="w-24 h-24 mb-4 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
                            <?php if (!empty($entreprise['logo'])): ?>
                                <!-- Affiche le logo si disponible -->
                                <img src="uploads/logos/<?php echo htmlspecialchars($entreprise['logo']); ?>"
                                    alt="Logo <?php echo htmlspecialchars($entreprise['NomEntreprise']); ?>"
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <!-- Icône par défaut si aucun logo n'est disponible -->
                                <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Nom de l'entreprise -->
                        <h3 class="text-lg font-medium text-gray-900 text-center">
                            <?php echo htmlspecialchars($entreprise['NomEntreprise']); ?>
                        </h3>

                        <!-- Secteur d'activité de l'entreprise -->
                        <?php if (!empty($entreprise['SecteurActivite'])): ?>
                            <p class="mt-1 text-sm text-gray-500">
                                <?php echo htmlspecialchars($entreprise['SecteurActivite']); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Ville de l'entreprise -->
                        <?php if (!empty($entreprise['Ville'])): ?>
                            <div class="mt-2 inline-flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <?php echo htmlspecialchars($entreprise['Ville']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Styles CSS pour la grille -->
<style>
    /* Grille responsive */
    .grid {
        display: grid;
        grid-auto-rows: 1fr;
    }

    /* Une colonne pour les petits écrans */
    @media (max-width: 640px) {
        .grid {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    /* Deux colonnes pour les écrans moyens */
    @media (min-width: 641px) and (max-width: 1024px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Quatre colonnes pour les grands écrans */
    @media (min-width: 1025px) {
        .grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
</style>