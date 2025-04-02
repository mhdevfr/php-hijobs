<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<div class="w-full min-h-screen bg-white p-4 sm:p-6 lg:p-8">
    <div class="w-full max-w-7xl mx-auto rounded-lg border border-gray-200 bg-white shadow-sm">
        <?php foreach ($etudiant as $etu) { ?>
            <div class="p-4 sm:p-6 lg:p-8 space-y-6">
                <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-gray-900">Information du profil</h1>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Nom</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['nom']; ?></p>
                    </div>
                    
                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Prénom</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['prenom']; ?></p>
                    </div>

                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Code Postal</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['codePostal']; ?></p>
                    </div>

                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Ville</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['Ville']; ?></p>
                    </div>

                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Adresse</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['Adresse']; ?></p>
                    </div>

                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Pays</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['Pays']; ?></p>
                    </div>

                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Téléphone</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['Telephone']; ?></p>
                    </div>

                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">E-mail</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['EmailEtudiant']; ?></p>
                    </div>

                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Niveau d'étude</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['NiveauEtude']; ?></p>
                    </div>

                    <div class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                        <p class="text-sm font-medium text-gray-500">Nom de la formation</p>
                        <p class="mt-1 text-sm text-gray-900"><?php echo $etu['NomFormation']; ?></p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <a href="index.php?section=formModifProfilEtu" 
                       class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Modifier votre profil
                    </a>
                    <a href="index.php?section=formSupprProfilEtu" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')"
                       class="inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Supprimer votre profil
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>