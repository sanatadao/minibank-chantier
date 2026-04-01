<?php
// =============================================
// controllers/comptesController.php
// Rôle : Gérer toutes les actions liées aux comptes
//        Suit exactement le même modèle que clientsController.php
// =============================================

include_once '../config/database.php';
include_once '../models/comptesModel.php';
include_once '../models/clientsModel.php'; // Nécessaire pour remplir le select des clients

class CompteController {
    private $conn;
    private $compte;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->compte = new Compte($this->conn);
    }

    // 1. Afficher la liste des comptes
    public function index() {
        // On récupère tous les comptes avec le nom du client (JOIN dans le modèle)
        $comptes = $this->compte->read();

        // On récupère aussi tous les clients pour le formulaire de création
        $clientModel = new Client($this->conn);
        $clients = $clientModel->read();

        include '../views/comptes/index.php';
    }

    // 2. Traitement de la création d'un compte (formulaire dans index.php)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php?action=comptes_index');
            exit;
        }

        $this->compte->numero_compte = trim($_POST['numero_compte']);
        $this->compte->client_id     = trim($_POST['client_id']);
        $this->compte->solde         = 0.00; // Le solde commence toujours à 0

        $this->compte->create();

        header('Location: /index.php?action=comptes_index&message=Compte+créé+avec+succès&type=success');
        exit;
    }

    // 3. Suppression d'un compte
    //    Bloquée si le compte a des transactions (géré dans le modèle)
    public function delete($id) {
        $this->compte->id = $id;

        // La méthode delete() du modèle vérifie d'abord s'il y a des transactions
        // Si oui → elle retourne false sans supprimer
        $resultat = $this->compte->delete();

        if ($resultat) {
            header('Location: /index.php?action=comptes_index&message=Compte+supprimé+avec+succès&type=success');
        } else {
            header('Location: /index.php?action=comptes_index&message=Impossible+de+supprimer+ce+compte+car+il+a+des+transactions&type=error');
        }
        exit;
    }
}
