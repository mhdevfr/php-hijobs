<div class="w-5/6 mt-12 h-full flex justify-start items-center">
    <!-- Conteneur du détail d'une annonce professionnelle ou particulier -->
    <div class="grid grid-cols-2 gap-4 z-0 ml-12 w-5/6 pb-12 h-full rounded-2xl bg-gray-100 justify-center">
        <h2 class="text-2xl font-bold">Détail de l'entreprise : <?php echo htmlspecialchars($entrepriseChoisie['nomEntreprise'] ?? 'N/A'); ?></h2>

        <!-- Affichage de l'adresse, du code postal, de la ville et du pays de l'entreprise -->
        <p>
            <strong>Adresse :</strong>
            <?php
            echo htmlspecialchars($entrepriseChoisie['adresseEntreprise'] ?? 'Adresse non disponible') . ', ' .
                htmlspecialchars($entrepriseChoisie['codePostal'] ?? '') . ' ' .
                htmlspecialchars($entrepriseChoisie['ville'] ?? '') . ', ' .
                htmlspecialchars($entrepriseChoisie['pays'] ?? '');
            ?>
        </p>

        <hr class="w-full border-2 border-gray-400 my-4">

        <!-- Affichage des informations de l'entreprise -->
        <h2 class="text-2xl font-bold">Informations :</h2>

        <!-- Affichage du secteur d'activité de l'entreprise -->
        <p><strong>Secteur d'activité :</strong> <?php echo htmlspecialchars($entrepriseChoisie['secteurActivite'] ?? 'Non spécifié'); ?></p>

        <hr class="w-full border-2 border-gray-400 my-4">

        <!-- Affichage des informations de contact de l'entreprise -->
        <h2 class="text-2xl font-bold">Moyens de contact :</h2>

        <!-- Affichage du numéro de téléphone de l'entreprise -->
        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($entrepriseChoisie['telephoneEntreprise'] ?? 'Non spécifié'); ?></p>

        <!-- Affichage de l'adresse email de l'entreprise -->
        <p><strong>Email :</strong> <?php echo htmlspecialchars($entrepriseChoisie['emailEntreprise'] ?? 'Non spécifié'); ?></p>

        <!-- Affichage du site web de l'entreprise -->
        <p><strong>Site web :</strong>
            <?php
            if (!empty($entrepriseChoisie['siteWeb'])) {
                echo '<a href="' . htmlspecialchars($entrepriseChoisie['siteWeb']) . '" target="_blank">Visiter</a>';
            } else {
                echo 'Non spécifié';
            }
            ?>
        </p>

        <hr class="w-full border-2 border-gray-400 my-4">

        <!-- Affichage du numéro de siret de l'entreprise -->
        <p><strong>Numéro de Siret :</strong> <?php echo htmlspecialchars($entrepriseChoisie['numeroSiret'] ?? 'Non spécifié'); ?></p>
        <button class="mb-6 mt-6">
            <a href="index.php?section=entreprise" class="bg-yellow-500 border-2 border-yellow-500 my-6 rounded py-1 px-2">Retour</a>
        </button>
    </div>
</div>