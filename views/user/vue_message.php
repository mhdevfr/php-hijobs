<?php
require_once 'controllers/messagesController.php';
$messages = afficherMessages();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                    }
                }
            }
        }
    </script>
    <title>Messages</title>
</head>
<body>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-10">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-900">Messages</h1>
            <p class="mt-2 text-sm text-gray-600">Gérez vos conversations avec les particuliers, entreprises et étudiants.</p>
        </div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="mb-6 bg-gray-50 border border-gray-200 text-gray-800 px-4 py-3 rounded relative" role="alert">
                <strong class="font-medium">Succès!</strong>
                <span class="block sm:inline">
                    <?php 
                    switch($_GET['success']) {
                        case 'message_lu':
                            echo "Le message a été marqué comme lu.";
                            break;
                        case 'reponse_envoyee':
                            echo "Votre réponse a été envoyée avec succès.";
                            break;
                        default:
                            echo "Opération réussie.";
                    }
                    ?>
                </span>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="mb-6 bg-gray-50 border border-red-200 text-red-800 px-4 py-3 rounded relative" role="alert">
                <strong class="font-medium">Erreur!</strong>
                <span class="block sm:inline">Une erreur est survenue lors du traitement de votre demande.</span>
            </div>
        <?php endif; ?>

        <div class="space-y-6">
            <?php if (isset($messages) && !empty($messages)): ?>
                <?php foreach ($messages as $message): 
                    $date = new DateTime($message['dateEnvoi']);
                    $dateFormatted = $date->format('d/m/Y à H:i');
                    $isUnread = !$message['lu'];
                ?>
                    <div class="bg-white rounded-lg border <?php echo $isUnread ? 'border-gray-300' : 'border-gray-200'; ?> shadow-sm overflow-hidden transition-all hover:shadow-md">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="flex items-center space-x-2">
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
                                        <?php if ($isUnread): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Nouveau
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1 flex items-center">
                                        <svg class="h-4 w-4 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <?php echo $dateFormatted; ?>
                                    </p>
                                </div>
                                
                                <?php if (!empty($message['titre_annonce_parti']) || !empty($message['titre_annonce_pro'])): ?>
                                    <div class="flex items-center text-sm text-gray-500 bg-gray-50 px-3 py-1 rounded-md">
                                        <svg class="h-4 w-4 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span class="font-medium">
                                            <?php echo htmlspecialchars($message['titre_annonce_parti'] ?? $message['titre_annonce_pro']); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="prose max-w-none text-gray-700 mb-6 mt-4 bg-gray-50 p-4 rounded-md">
                                <?php echo nl2br(htmlspecialchars($message['contenuMessage'])); ?>
                            </div>

                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex space-x-2">
                                    <button onclick="toggleReplyForm('reply-<?php echo $message['idMessage']; ?>')"
                                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                        </svg>
                                        Répondre
                                    </button>
                                </div>

                                <?php if ($isUnread): ?>
                                    <form action="index.php?section=messages&action=marquerLu" method="post" class="inline">
                                        <input type="hidden" name="idMessage" value="<?php echo $message['idMessage']; ?>">
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                            <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Marquer comme lu
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>

                            <div id="reply-<?php echo $message['idMessage']; ?>" class="hidden mt-4 border-t border-gray-100 pt-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Votre réponse</h4>
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
                                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                            Annuler
                                        </button>
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                            Envoyer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            <?php else: ?>
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                    <div class="text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun message</h3>
                        <p class="mt-2 text-base text-gray-500 max-w-md mx-auto">
                            Vous n'avez pas encore reçu de messages. Lorsque quelqu'un vous contactera, ses messages apparaîtront ici.
                        </p>
                        <div class="mt-6">
                            <a href="index.php?section=annonce" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                Parcourir les annonces
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
    function toggleReplyForm(formId) {
        const form = document.getElementById(formId);
        form.classList.toggle('hidden');
        
        if (!form.classList.contains('hidden')) {
            const textarea = form.querySelector('textarea');
            textarea.focus();
            form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }
    </script>
</body>
</html> 