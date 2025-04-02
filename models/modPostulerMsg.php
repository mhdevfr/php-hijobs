<?php
function envoyerCandidature($annonceId, $etudiantId, $message)
{
    global $connexion;
    try {
        $queryAnnonce = $connexion->prepare("
            SELECT type_annonce, numAnnoncePro, numAnnonceParti 
            FROM annonces 
            WHERE id = :annonceId
        ");
        $queryAnnonce->execute(['annonceId' => $annonceId]);
        $annonce = $queryAnnonce->fetch();
        if (!$annonce) {
            return false;
        }
        $receiverType = $annonce['type_annonce'] === 'professionnel' ? 'professionnelle' : 'particulier';
        $receiverId = $receiverType === 'professionnelle' ? $annonce['numAnnoncePro'] : $annonce['numAnnonceParti'];
        $insertNotif = $connexion->prepare("
            INSERT INTO notifications (sender_type, sender_id, receiver_type, receiver_id, type, message)
            VALUES ('etudiant', :etudiantId, :receiverType, :receiverId, 'nouvelle candidature', :message)
        ");
        $insertNotif->execute([
            'etudiantId' => $etudiantId,
            'receiverType' => $receiverType,
            'receiverId' => $receiverId,
            'message' => $message
        ]);

        return true; 
    } catch (Exception $e) {
        return false;
    }
}
?>