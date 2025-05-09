<?php
// components/DetailAnnonceProComp.php
//
// Fonction pour convertir un mois numérique en mois en français
function formatMoisFr($mois)
{
    $moisFr = [
        '01' => 'janvier',
        '02' => 'février',
        '03' => 'mars',
        '04' => 'avril',
        '05' => 'mai',
        '06' => 'juin',
        '07' => 'juillet',
        '08' => 'août',
        '09' => 'septembre',
        '10' => 'octobre',
        '11' => 'novembre',
        '12' => 'décembre'
    ];
    // Retourne le mois en français ou le mois original si non trouvé
    return $moisFr[$mois] ?? $mois;
}

// Vérifie si l'annonce sélectionnée existe et n'est pas vide
if (isset($annonceChoisi) && !empty($annonceChoisi)) {
    // Récupération des données de l'annonce avec des valeurs par défaut si elles sont absentes
    $wDescAnn = $annonceChoisi['descAnnoncePro'] ?? '';
    $wTitreAnn = $annonceChoisi['titreAnnoncePro'] ?? '';
    $wVilleAnn = $annonceChoisi['villeAnnoncePro'] ?? '';
    $wEntreprise = $annonceChoisi['NomEntreprise'] ?? '';
    $wActiviteAnn = $annonceChoisi['intitAct'] ?? '';
    $wLieuAnn = $annonceChoisi['intitLieu'] ?? '';
    $wTypeContrat = $annonceChoisi['typeContrat'] ?? '';
    $wPubliAnn = $annonceChoisi['created_at'] ?? '';
    // Formatage de la date de publication
    list($Y, $M, $D) = explode("-", $wPubliAnn);
    $M = formatMoisFr($M);
?>

    <!-- Conteneur principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Bouton de retour aux annonces -->
        <div class="mb-6">
            <a href="index.php?section=annonce" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour aux annonces
            </a>
        </div>

        <!-- Grille principale pour le contenu -->
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Section principale de l'annonce -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                    <div class="p-6 space-y-6 h-full flex flex-col">
                        <!-- Titre et informations principales -->
                        <div class="space-y-2">
                            <h1 class="text-2xl font-semibold text-gray-900">
                                <?php echo htmlspecialchars($wTitreAnn); ?>
                                <span class="inline-flex items-center px-3 py-1 ml-3 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    <?php echo htmlspecialchars($wVilleAnn); ?>
                                </span>
                            </h1>
                            <p class="text-lg text-gray-700">
                                Entreprise : <span class="font-medium"><?php echo htmlspecialchars($wEntreprise); ?></span>
                            </p>
                        </div>

                        <!-- Activité, lieu et type de contrat -->
                        <div class="flex flex-wrap gap-4">
                            <?php if (!empty($wActiviteAnn)): ?>
                                <div class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                                    <svg class="h-5 w-5 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <?php echo htmlspecialchars($wActiviteAnn); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($wLieuAnn)): ?>
                                <div class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                                    <svg class="h-5 w-5 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <?php echo htmlspecialchars($wLieuAnn); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($wTypeContrat)): ?>
                                <div class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                                    <svg class="h-5 w-5 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <?php echo htmlspecialchars($wTypeContrat); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Description de l'annonce -->
                        <div class="prose max-w-none text-gray-700 flex-grow">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                            <div class="min-h-[150px]">
                                <p><?php echo nl2br(htmlspecialchars($wDescAnn)); ?></p>
                            </div>
                        </div>

                        <!-- Date de publication et bouton "Postuler" -->
                        <div class="pt-6 border-t border-gray-200 mt-auto">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Publié le <?php echo $D . ' ' . $M . ' ' . $Y; ?>
                                    <?php if (!empty($wEntreprise)): ?>
                                        par <?php echo htmlspecialchars($wEntreprise); ?>
                                    <?php endif; ?>
                                </div>

                                <button onclick="apparition()"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Postuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Formulaire de candidature -->
            <!-- ... -->

            <div id="formPostuler" class="hidden lg:block lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden h-full min-h-[500px]">
                    <div class="p-6 space-y-6 h-full flex flex-col">
                        <h2 class="text-lg font-medium text-gray-900">
                            Contacter <?php echo htmlspecialchars($wEntreprise); ?>
                        </h2>

                        <form action="index.php?section=envoyerMessageAnnonce" method="post" class="space-y-4 flex-grow flex flex-col">
                            <input type="hidden" name="numAnnoncePro" value="<?php echo htmlspecialchars($annonceChoisi['numAnnoncePro'] ?? ''); ?>">

                            <?php if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'etudiant'): ?>
                                <div class="space-y-1">
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Prénom
                                    </label>
                                    <input type="text"
                                        id="name"
                                        name="name"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="space-y-1">
                                    <label for="lastname" class="block text-sm font-medium text-gray-700">
                                        Nom
                                    </label>
                                    <input type="text"
                                        id="lastname"
                                        name="lastname"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="space-y-1">
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email
                                    </label>
                                    <input type="email"
                                        id="email"
                                        name="email"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                        required>
                                </div>
                            <?php endif; ?>

                            <div class="space-y-1 flex-grow">
                                <label for="message" class="block text-sm font-medium text-gray-700">
                                    Votre message
                                </label>
                                <textarea id="message"
                                    name="message"
                                    rows="6"
                                    required
                                    placeholder="Rédigez un message pour accompagner votre candidature"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm resize-none flex-grow"></textarea>
                            </div>

                            <div class="space-y-1">
                                <label for="cv" class="block text-sm font-medium text-gray-700">
                                    CV (optionnel)
                                </label>
                                <input type="file"
                                    id="cv"
                                    name="cv"
                                    accept=".pdf,.doc,.docx"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                <p class="mt-1 text-xs text-gray-500">PDF, DOC ou DOCX. Max 5MB.</p>
                            </div>

                            <button type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors mt-auto">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Envoyer ma candidature
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="formPostulerMobile" class="hidden lg:hidden mt-6">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 space-y-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Contacter <?php echo htmlspecialchars($wEntreprise); ?>
                    </h2>

                    <form action="index.php?section=envoyerMessageAnnonce" method="post" class="space-y-4">
                        <input type="hidden" name="numAnnoncePro" value="<?php echo htmlspecialchars($annonceChoisi['numAnnoncePro'] ?? ''); ?>">

                        <?php if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'etudiant'): ?>
                            <div class="space-y-1">
                                <label for="name_mobile" class="block text-sm font-medium text-gray-700">
                                    Prénom
                                </label>
                                <input type="text"
                                    id="name_mobile"
                                    name="name"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                    required>
                            </div>

                            <div class="space-y-1">
                                <label for="lastname_mobile" class="block text-sm font-medium text-gray-700">
                                    Nom
                                </label>
                                <input type="text"
                                    id="lastname_mobile"
                                    name="lastname"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                    required>
                            </div>

                            <div class="space-y-1">
                                <label for="email_mobile" class="block text-sm font-medium text-gray-700">
                                    Email
                                </label>
                                <input type="email"
                                    id="email_mobile"
                                    name="email"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                    required>
                            </div>
                        <?php endif; ?>

                        <div class="space-y-1">
                            <label for="message_mobile" class="block text-sm font-medium text-gray-700">
                                Votre message
                            </label>
                            <textarea id="message_mobile"
                                name="message"
                                rows="6"
                                required
                                placeholder="Rédigez un message pour accompagner votre candidature"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm resize-none"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Envoyer ma candidature
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
} else {
    // Message d'erreur si l'annonce n'existe pas
    echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                <p class="text-gray-500 text-lg">Cette annonce n\'existe pas ou a été supprimée.</p>
                <a href="index.php?section=annonce" class="inline-block mt-4 text-black hover:underline">
                    Retourner aux annonces
                </a>
            </div>
          </div>';
}
?>

<script>
    // Fonction pour afficher/masquer le formulaire de candidature
    function apparition() {
        const formPostulerDesktop = document.getElementById('formPostuler');
        const formPostulerMobile = document.getElementById('formPostulerMobile');

        if (window.innerWidth >= 1024) {
            formPostulerDesktop.classList.toggle('hidden');
            if (!formPostulerDesktop.classList.contains('hidden')) {
                formPostulerDesktop.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        } else {
            formPostulerMobile.classList.toggle('hidden');
            if (!formPostulerMobile.classList.contains('hidden')) {
                formPostulerMobile.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    }
</script>