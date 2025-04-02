<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="w-full">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Modifier votre annonce</h1>
            <a href="<?php echo isset($_SESSION['idParti']) ? 'index.php?section=acc-parti' : 'index.php?section=acc-off'; ?>" 
               class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Retour
            </a>
        </div>

        <form action="index.php?section=ModifAnnonce" method="post" class="space-y-4">
            <?php if (!empty($annonceModif)) {
                foreach ($annonceModif as $modif) {
                    $isEntreprise = isset($_SESSION['idEntreprise']);
                    $isParti = isset($_SESSION['idParti']);

                    if (($isEntreprise && $modif['idEntreprise'] == $_SESSION['idEntreprise']) ||
                        ($isParti && $modif['idParti'] == $_SESSION['idParti'])) { ?>

                        <input type="hidden" name="<?php echo $isEntreprise ? 'numAnnoncePro' : 'numAnnonceParti'; ?>" 
                               value="<?php echo $isEntreprise ? $modif['numAnnoncePro'] : $modif['numAnnonceParti']; ?>">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Titre</label>
                                <input type="text" required 
                                       value="<?php echo $isEntreprise ? htmlspecialchars($modif['titreAnnoncePro'] ?? '') : htmlspecialchars($modif['titreAnnonce'] ?? ''); ?>" 
                                       name="<?php echo $isEntreprise ? 'titreAnnoncePro' : 'titreAnnonceParti'; ?>"
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" required 
                                       value="<?php echo $isEntreprise ? htmlspecialchars($modif['NomEntreprise'] ?? '') : htmlspecialchars($modif['NomParti'] ?? ''); ?>" 
                                       name="<?php echo $isEntreprise ? 'nomEntreprise' : 'nomParti'; ?>"
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <?php if ($isParti) { ?>
                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700">Prénom</label>
                                    <input type="text" required 
                                           value="<?php echo htmlspecialchars($modif['PrenomParti'] ?? ''); ?>" 
                                           name="prenomParti"
                                           class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                </div>
                            <?php } ?>

                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-700">Ville</label>
                                <input type="text" required 
                                       value="<?php echo $isEntreprise ? htmlspecialchars($modif['villeAnnoncePro'] ?? '') : htmlspecialchars($modif['villeAnnonceParti'] ?? ''); ?>" 
                                       name="<?php echo $isEntreprise ? 'villeAnnoncePro' : 'villeAnnonceParti'; ?>"
                                       class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

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

                            <div class="space-y-1 sm:col-span-2">
                                <label class="text-sm font-medium text-gray-700">Description</label>
                                <textarea required 
                                          name="<?php echo $isEntreprise ? 'descriptionAnnoncePro' : 'descriptionAnnonceParti'; ?>"
                                          class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent min-h-[100px]"><?php echo $isEntreprise ? htmlspecialchars($modif['descAnnoncePro'] ?? '') : htmlspecialchars($modif['descriptionParti'] ?? ''); ?></textarea>
                            </div>
                        </div>

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