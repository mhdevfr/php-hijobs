<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <?php if(isset($_SESSION['userType']) && isset($_SESSION['userId'])): ?>
    <div class="bg-gray-100 p-4 mb-6 rounded-lg">
        <h2 class="font-semibold mb-2">Informations de débogage:</h2>
        <div class="text-sm">
            <p>Type utilisateur: <?php echo $_SESSION['userType']; ?></p>
            <p>ID utilisateur: <?php echo $_SESSION['userId']; ?></p>
            
            <?php
            $debugQuery = "SELECT * FROM messages WHERE ";
            switch($_SESSION['userType']) {
                case 'particulier':
                    $debugQuery .= "idParti = " . $_SESSION['userId'];
                    break;
                case 'entreprise':
                    $debugQuery .= "idEntreprise = " . $_SESSION['userId'];
                    break;
                case 'etudiant':
                    $debugQuery .= "idEtudiant = " . $_SESSION['userId'];
                    break;
            }
            
            try {
                $debugStmt = $connexion->query($debugQuery);
                $debugMessages = $debugStmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<p>Requête exécutée: " . htmlspecialchars($debugQuery) . "</p>";
                echo "<p>Nombre de messages trouvés: " . count($debugMessages) . "</p>";
                
                if (count($debugMessages) > 0) {
                    echo "<details>";
                    echo "<summary>Afficher les détails des messages</summary>";
                    echo "<pre>";
                    print_r($debugMessages);
                    echo "</pre>";
                    echo "</details>";
                }
                
                echo "<p>Variable \$messages: ";
                if (isset($messages)) {
                    echo "définie, contient " . count($messages) . " message(s)</p>";
                    if (count($messages) === 0 && count($debugMessages) > 0) {
                        echo "<p class='text-red-600 font-bold'>ERREUR: Les messages existent dans la base de données mais ne sont pas chargés correctement!</p>";
                    }
                } else {
                    echo "<p class='text-red-600 font-bold'>non définie! La variable \$messages n'est pas disponible.</p>";
                }
            } catch (PDOException $e) {
                echo "<p class='text-red-600'>Erreur SQL: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-semibold text-gray-900 mb-6">Messages reçus</h1>
            
            <div class="space-y-6">
                <?php
                if (isset($messages) && !empty($messages)) {
                    foreach ($messages as $message): 
                        $date = new DateTime($message['dateEnvoi']);
                        $dateFormatted = $date->format('d/m/Y à H:i');
                ?>
                    <div class="border rounded-lg p-4 <?php echo $message['lu'] ? 'bg-white' : 'bg-gray-50'; ?>">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    <?php 
                                    if (!empty($message['nom_etudiant'])) {
                                        echo htmlspecialchars($message['nom_etudiant'] . ' ' . $message['prenom_etudiant']);
                                    } elseif (!empty($message['NomEntreprise'])) {
                                        echo htmlspecialchars($message['NomEntreprise']);
                                    } elseif (!empty($message['NomParti'])) {
                                        echo htmlspecialchars($message['NomParti'] . ' ' . $message['PrenomParti']);
                                    }
                                    ?>
                                </h3>
                                <p class="text-sm text-gray-500">
                                    <?php echo $dateFormatted; ?>
                                    <?php if (!$message['lu']): ?>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Nouveau
                                        </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            
                            <?php if (!empty($message['titre_annonce_parti']) || !empty($message['titre_annonce_pro'])): ?>
                                <div class="text-sm text-gray-500">
                                    En réponse à : 
                                    <span class="font-medium">
                                        <?php echo htmlspecialchars($message['titre_annonce_parti'] ?? $message['titre_annonce_pro']); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="prose max-w-none text-gray-700 mb-4">
                            <?php echo nl2br(htmlspecialchars($message['contenuMessage'])); ?>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <button onclick="toggleReplyForm('reply-<?php echo $message['idMessage']; ?>')"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                </svg>
                                Répondre
                            </button>

                            <?php if (!$message['lu']): ?>
                                <form action="index.php?section=messages&action=marquerLu" method="post" class="inline">
                                    <input type="hidden" name="idMessage" value="<?php echo $message['idMessage']; ?>">
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                        Marquer comme lu
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <div id="reply-<?php echo $message['idMessage']; ?>" class="hidden mt-4">
                            <form action="index.php?section=messages&action=repondre" method="post" class="space-y-4">
                                <input type="hidden" name="message_original_id" value="<?php echo $message['idMessage']; ?>">
                                <input type="hidden" name="destinataire_type" value="<?php 
                                    if (!empty($message['idEtudiant'])) echo 'etudiant';
                                    elseif (!empty($message['idEntreprise'])) echo 'entreprise';
                                    else echo 'particulier';
                                ?>">
                                <input type="hidden" name="destinataire_id" value="<?php 
                                    echo $message['idEtudiant'] ?? $message['idEntreprise'] ?? $message['idParti']; 
                                ?>">
                                
                                <div>
                                    <label for="reponse-<?php echo $message['idMessage']; ?>" class="sr-only">
                                        Votre réponse
                                    </label>
                                    <textarea id="reponse-<?php echo $message['idMessage']; ?>"
                                            name="message"
                                            rows="4"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                            placeholder="Écrivez votre réponse..."
                                            required></textarea>
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <button type="button"
                                            onclick="toggleReplyForm('reply-<?php echo $message['idMessage']; ?>')"
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                        Annuler
                                    </button>
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                        Envoyer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php 
                    endforeach;
                } else {
                ?>
                    <div class="text-center py-12">
                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun message</h3>
                        <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore reçu de messages.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
function toggleReplyForm(formId) {
    const form = document.getElementById(formId);
    form.classList.toggle('hidden');
    
    if (!form.classList.contains('hidden')) {
        const textarea = form.querySelector('textarea');
        textarea.focus();
    }
}
</script> 