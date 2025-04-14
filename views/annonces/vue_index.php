<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces - HIJOBS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="h-full w-full flex items-center flex-col">
        <?php include "./components/navbar.php" ?>
        <!-- Conteneur principal -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="lg:grid lg:grid-cols-4 mt-24 lg:gap-8">
                <div class="col-span-1">
                    <div class="sticky top-8 bg-white rounded-lg border border-gray-200 p-6 space-y-4">
                        <!-- Filtre de recherche d'annonce -->
                        <form id="filterForm" class="space-y-4">
                            <div class="space-y-2">
                                <label for="searchInput" class="text-sm font-medium text-gray-700">Rechercher une annonce</label>
                                <div class="relative">
                                    <input type="text" 
                                           id="searchInput" 
                                           placeholder="Rechercher par titre..." 
                                           class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent pl-10">
                                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Valider le filtre -->
                            <button type="button" 
                                    id="submitButton" 
                                    class="w-full inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Appliquer les filtres
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Conteneur des annonces -->
                <div class="lg:col-span-3 space-y-6" id="annoncesContainer">
                    <?php if (!empty($annonces)): ?>
                        <?php foreach ($annonces as $annonce):
                            $isProAnnonce = ($annonce['type_annonce'] ?? '') === 'professionnel';
                            $dataTitre = htmlspecialchars($annonce['titreAnnoncePro'] ?? $annonce['titreAnnonce'] ?? 'Sans titre');
                        ?>
                            <div class="annonce-card bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200" 
                                 data-titre="<?php echo $dataTitre; ?>">
                                <a href="index.php?section=<?php echo $isProAnnonce ? 'DetailAnnoncePro' : 'DetailAnnonceParti'; ?>&choixId=<?php echo $isProAnnonce ? $annonce['numAnnoncePro'] : $annonce['numAnnonceParti']; ?>" 
                                   class="block p-6">
                                    <div class="space-y-4">
                                        <div>
                                            <!-- Affichage du titre de l'annonce -->
                                            <h2 class="text-xl font-semibold text-gray-900">
                                                <?php echo $isProAnnonce ? 
                                                    htmlspecialchars($annonce['titreAnnoncePro'] ?? '') : 
                                                    htmlspecialchars($annonce['titreAnnonce'] ?? ''); ?>
                                            </h2>
                                            <!-- Affichage de l'entreprise ou du particulier -->
                                            <p class="text-sm text-gray-600 mt-1">
                                                <?php echo $isProAnnonce ? 
                                                    htmlspecialchars($annonce['nomEntreprise'] ?? 'Entreprise non spécifiée') : 
                                                    htmlspecialchars($annonce['nom_complet'] ?? 'Particulier non trouvé'); ?>
                                            </p>
                                        </div>

                                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span>
                                                <!-- Affichage de la ville de l'annonce -->
                                                <?php echo $isProAnnonce ? 
                                                    htmlspecialchars($annonce['villeAnnoncePro'] ?? '') : 
                                                    htmlspecialchars($annonce['villeAnnonceParti'] ?? ''); ?>
                                            </span>
                                        </div>
                                        
                                        <!-- Affichage du type de contrat si c'est une annonce professionnelle -->
                                        <?php if ($isProAnnonce && isset($annonce['typeContrat'])): ?>
                                            <div class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-800">
                                                <?php echo htmlspecialchars($annonce['typeContrat']); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="text-sm text-gray-700">
                                            <?php 
                                                // Affichage de la description de l'annonce
                                                $description = $isProAnnonce ? 
                                                    htmlspecialchars($annonce['descAnnoncePro'] ?? '') : 
                                                    htmlspecialchars($annonce['descriptionParti'] ?? '');
                                                echo strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description; 
                                            ?>
                                        </div>

                                        <div class="flex justify-between items-center pt-4 text-sm text-gray-500 border-t border-gray-200">
                                            <!-- Affichage de la date de création de l'annonce -->
                                            <span>Créé le <?php echo htmlspecialchars($annonce['created_at'] ?? ''); ?></span>
                                            <span>
                                                Publié par <?php echo htmlspecialchars($annonce['nomEntreprise'] ?? $annonce['nom_complet'] ?? ''); ?>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">Aucune annonce disponible.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php include "./components/footer.php" ?>
    </div>

    <script>
        // Script pour le filtre de recherche d'annonce
        const searchInput = document.getElementById('searchInput');
        const submitButton = document.getElementById('submitButton');
        const annonces = document.querySelectorAll('.annonce-card');

        submitButton.addEventListener('click', () => {
            const searchQuery = searchInput.value.toLowerCase();
            annonces.forEach(annonce => {
                const titre = annonce.getAttribute('data-titre').toLowerCase();
                annonce.style.display = titre.includes(searchQuery) ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>