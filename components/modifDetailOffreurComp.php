<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="w-full">
        <!-- En-tête avec le titre et le bouton de retour -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Modifier votre annonce</h1>
            <a href="<?php echo isset($_SESSION['idParti']) ? 'index.php?section=acc-parti' : 'index.php?section=acc-off'; ?>"
                class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Retour
            </a>
        </div>

        <!-- Formulaire de modification -->
        <form action="index.php?section=ModifAnnonce" method="post" class="space-y-4">
            <?php if (!empty($annonceModif)) {
                // Vérifie si des données d'annonce sont disponibles
                foreach ($annonceModif as $modif) {
                    $isEntreprise = isset($_SESSION['idEntreprise']);
                    $isParti = isset($_SESSION['idParti']);

                    // Vérifie si l'utilisateur connecté est autorisé à modifier cette annonce
                    if (($isEntreprise && $modif['idEntreprise'] == $_SESSION['idEntreprise']) ||
                        ($isParti && $modif['idParti'] == $_SESSION['idParti'])
                    ) { ?>

                        <!-- Champ caché pour l'identifiant de l'annonce -->
                        <input type="hidden" name="<?php echo $isEntreprise ? 'numAnnoncePro' : 'numAnnonceParti'; ?>"
                            value="<?php echo $isEntreprise ? $modif['numAnnoncePro'] : $modif['numAnnonceParti']; ?>">

                        <!-- Grille pour les champs du formulaire -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Champ pour le titre -->
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Titre</label>
                                <input type="text" required
                                    value="<?php echo $isEntreprise ? htmlspecialchars($modif['titreAnnoncePro'] ?? '') : htmlspecialchars($modif['titreAnnonce'] ?? ''); ?>"
                                    name="<?php echo $isEntreprise ? 'titreAnnoncePro' : 'titreAnnonceParti'; ?>"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <!-- Champ pour le nom -->
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" required
                                    value="<?php echo $isEntreprise ? htmlspecialchars($modif['NomEntreprise'] ?? '') : htmlspecialchars($modif['NomParti'] ?? ''); ?>"
                                    name="<?php echo $isEntreprise ? 'nomEntreprise' : 'nomParti'; ?>"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <!-- Champ pour le prénom (uniquement pour les particuliers) -->
                            <?php if ($isParti) { ?>
                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700">Prénom</label>
                                    <input type="text" required
                                        value="<?php echo htmlspecialchars($modif['PrenomParti'] ?? ''); ?>"
                                        name="prenomParti"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                </div>
                            <?php } ?>

                            <!-- Champ pour la ville -->
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Ville</label>
                                <input type="text" required
                                    value="<?php echo $isEntreprise ? htmlspecialchars($modif['villeAnnoncePro'] ?? '') : htmlspecialchars($modif['villeAnnonceParti'] ?? ''); ?>"
                                    name="<?php echo $isEntreprise ? 'villeAnnoncePro' : 'villeAnnonceParti'; ?>"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <!-- Champ pour le type de contrat (uniquement pour les entreprises) -->
                            <?php if ($isEntreprise) { ?>
                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700">Type de contrat</label>
                                    <select name="typeContrat" id="typeContrat"
                                        class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                        <?php foreach ($TypeContrat as $type) { ?>
                                            <option value="<?php echo $type['IntituleContrat']; ?>">
                                                <?php echo $type['IntituleContrat']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>

                            <!-- Champ pour la description -->
                            <div class="space-y-1 sm:col-span-2">
                                <label class="text-sm font-medium text-gray-700">Description</label>
                                <textarea required
                                    name="<?php echo $isEntreprise ? 'descriptionAnnoncePro' : 'descriptionAnnonceParti'; ?>"
                                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent min-h-[100px]"><?php echo $isEntreprise ? htmlspecialchars($modif['descAnnoncePro'] ?? '') : htmlspecialchars($modif['descriptionParti'] ?? ''); ?></textarea>
                            </div>
                        </div>

                        <!-- Bouton pour soumettre les modifications -->
                        <div class="pt-6">
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Enregistrer les modifications
                            </button>
                        </div>
            <?php }
                }
            } ?>
        </form>
    </div>
</div>