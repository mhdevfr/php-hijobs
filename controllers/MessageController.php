<?php
require_once 'models/Message.php';

class MessageController {
    private $messageModel;

    public function __construct($db) {
        $this->messageModel = new Message($db);
    }

    public function envoyerMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['userType'])) {
            $expediteur = [
                'type' => $_SESSION['userType'],
                'id' => $_SESSION['userId']
            ];

            $annonce = [
                'type' => $_POST['type_annonce'],     
                'id' => $_POST['id_annonce']
            ];

            if ($this->messageModel->envoyerMessage(
                $expediteur,
                $_POST['destinataire'],
                $annonce,
                $_POST['message']
            )) {
                header('Location: index.php?section=messages&success=1');
                exit;
            }
        }
        header('Location: index.php?section=messages&error=1');
        exit;
    }

    public function afficherMessages() {
        if (!isset($_SESSION['userType']) || !isset($_SESSION['userId'])) {
            header('Location: index.php?section=login');
            exit;
        }

        $messages = $this->messageModel->getMessagesRecus(
            $_SESSION['userType'],
            $_SESSION['userId']
        );

        return $messages;
    }
} 