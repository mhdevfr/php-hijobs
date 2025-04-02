<?php
$unreadCount = 0;
if (isset($_SESSION['userType']) && isset($_SESSION['userId'])) {
    try {
        $userType = $_SESSION['userType'];
        $userId = $_SESSION['userId'];
        
        $query = "SELECT COUNT(*) FROM messages WHERE lu = FALSE AND ";
        
        switch($userType) {
            case 'particulier':
                $query .= "idParti = :id";
                break;
            case 'entreprise':
                $query .= "idEntreprise = :id";
                break;
            case 'etudiant':
                $query .= "idEtudiant = :id";
                break;
        }
        
        $stmt = $connexion->prepare($query);
        $stmt->execute([':id' => $userId]);
        $unreadCount = $stmt->fetchColumn();
    } catch (PDOException $e) {
    }
}
?>

<nav class="bg-white  w-4/5 z-50 top-0 border mt-12 rounded-lg border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0">
                <a href="index.php" class="flex items-center">
                    <span class="text-2xl font-bold text-black">Hi<span class="text-orange-400">Jobs</span></span>
                </a>
            </div>
            <div class="hidden md:flex md:items-center md:justify-end md:flex-1">
                <div class="flex space-x-8">
                    <?php if (!isset($_SESSION['validiteConnexion']) || !$_SESSION['validiteConnexion']): ?>
                        <a href="index.php?section=index" class="text-gray-600 hover:text-black transition-colors px-3 py-2">Accueil</a>
                        <a href="index.php?section=connecter" class="text-gray-600 hover:text-black transition-colors px-3 py-2">Annonces</a>
                        <a href="index.php?section=connecter" class="text-gray-600 hover:text-black transition-colors px-3 py-2">Entreprises</a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['validiteConnexion']) && $_SESSION['validiteConnexion']): ?>
                        <a href="index.php?section=annonce" class="text-gray-600 hover:text-black transition-colors px-3 py-2">Annonces</a>
                        <a href="index.php?section=entreprise" class="text-gray-600 hover:text-black transition-colors px-3 py-2">Entreprises</a>
                        <?php if (isset($_SESSION['userType'])): ?>
                            <?php
                            $dashboardLinks = [
                                'particulier' => 'acc-parti',
                                'professionnel' => 'acc-off',
                                'etudiant' => 'acc-etu'
                            ];
                            
                            if (isset($dashboardLinks[$_SESSION['userType']])): ?>
                                <a href="index.php?section=<?php echo $dashboardLinks[$_SESSION['userType']]; ?>" 
                                   class="text-gray-600 hover:text-black transition-colors px-3 py-2">
                                    Compte
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <?php if (isset($_SESSION['validiteConnexion']) && $_SESSION['validiteConnexion']): ?>
                    <a href="index.php?section=messages" class="relative text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium inline-flex items-center">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <?php if ($unreadCount > 0): ?>
                            <span class="absolute -top-0.5 -right-0.5 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-black rounded-full min-w-[1.25rem]">
                                <?php echo $unreadCount; ?>
                            </span>
                        <?php endif; ?>
                    </a>

                   
                    <a href="index.php?section=logout" 
                       class="inline-flex items-center ml-2 px-2 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Déconnexion
                    </a>
                <?php else: ?>
                    <a href="index.php?section=connecter" 
                       class="inline-flex items-center px-4 ml-2 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Connexion
                    </a>
                <?php endif; ?>

                <div class="md:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <?php if (!isset($_SESSION['validiteConnexion']) || !$_SESSION['validiteConnexion']): ?>
                <a href="index.php?section=index" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-black hover:bg-gray-50 transition-colors">Accueil</a>
                <a href="index.php?section=connecter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-black hover:bg-gray-50 transition-colors">Annonces</a>
                <a href="index.php?section=connecter" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-black hover:bg-gray-50 transition-colors">Entreprises</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['validiteConnexion']) && $_SESSION['validiteConnexion']): ?>
                <a href="index.php?section=annonce" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-black hover:bg-gray-50 transition-colors">Annonces</a>
                <a href="index.php?section=entreprise" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-black hover:bg-gray-50 transition-colors">Entreprises</a>
                
                <?php if (isset($_SESSION['userType']) && isset($dashboardLinks[$_SESSION['userType']])): ?>
                    <a href="index.php?section=<?php echo $dashboardLinks[$_SESSION['userType']]; ?>" 
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-black hover:bg-gray-50 transition-colors">
                        Compte
                    </a>
                <?php endif; ?>
                
                <a href="index.php?section=messages" class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Messages
                    <?php if ($unreadCount > 0): ?>
                        <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-black rounded-full">
                            <?php echo $unreadCount; ?>
                        </span>
                    <?php endif; ?>
                </a>

                <div class="px-3 py-3 space-y-3">
                    <span class="block text-sm font-medium text-gray-900">
                        <?php echo htmlspecialchars($_SESSION['prenomUser']); ?>
                    </span>
                    <a href="index.php?section=logout" 
                       class="block w-full text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 transition-colors">
                        Déconnexion
                    </a>
                </div>
            <?php else: ?>
                <a href="index.php?section=connecter" 
                   class="block w-full text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 transition-colors">
                    Connexion
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('hidden');
}
</script>
