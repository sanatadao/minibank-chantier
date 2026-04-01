<?php
// =============================================
// controllers/transactionsController.php
// Rôle : Gérer toutes les actions liées aux transactions
//        Suit exactement le même modèle que clientsController.php
// =============================================

include_once '../config/database.php';
include_once '../models/transactionsModel.php';
include_once '../models/comptesModel.php'; // Nécessaire pour lire le solde du compte

class TransactionController {
    private $conn;
    private $transaction;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->transaction = new Transaction($this->conn);
    }

    // 1. Afficher l'historique des transactions d'un compte
    public function index() {
        // On récupère l'id du compte depuis l'URL (?compte_id=X)
        $compte_id = $_GET['compte_id'] ?? null;

        if (!$compte_id) {
            header('Location: /index.php?action=comptes_index');
            exit;
        }

        // On récupère les infos du compte (solde, numéro, titulaire)
        $compteModel = new Compte($this->conn);
        $compte = $compteModel->read($compte_id);

        if (!$compte) {
            header('Location: /index.php?action=comptes_index&message=Compte+introuvable&type=error');
            exit;
        }

        // On récupère toutes les transactions de ce compte
        $transactions = $this->transaction->read($compte_id);

        include '../views/transactions/index.php';
    }

    // 2. Traitement d'une transaction (dépôt ou retrait)
    //    Le type est déterminé par le champ "type" du formulaire
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php?action=comptes_index');
            exit;
        }

        $compte_id = trim($_POST['compte_id']);
        $type      = trim($_POST['type']);
        $montant   = floatval($_POST['montant']);

        // Vérifications de base
        if ($compte_id === '' || $type === '' || $montant <= 0) {
            header('Location: /index.php?action=transactions_index&compte_id=' . $compte_id . '&message=Données+invalides&type=error');
            exit;
        }

        // On récupère le solde actuel du compte
        $compteModel = new Compte($this->conn);
        $compte = $compteModel->read($compte_id);

        if (!$compte) {
            header('Location: /index.php?action=comptes_index&message=Compte+introuvable&type=error');
            exit;
        }

        $solde_actuel = floatval($compte['solde']);

        // -----------------------------------------------
        // RÈGLE MÉTIER : vérification du solde pour retrait
        // Un retrait impossible ne doit PAS modifier la base
        // -----------------------------------------------
        if ($type === 'retrait' && $solde_actuel < $montant) {
            header('Location: /index.php?action=transactions_index&compte_id=' . $compte_id . '&message=Solde+insuffisant+pour+effectuer+ce+retrait&type=error');
            exit;
        }

        // Tout est OK — on enregistre la transaction
        $this->transaction->type      = $type;
        $this->transaction->montant   = $montant;
        $this->transaction->compte_id = $compte_id;
        $this->transaction->create();

        // On calcule le nouveau solde
        if ($type === 'depot') {
            $nouveau_solde = $solde_actuel + $montant;
        } else {
            $nouveau_solde = $solde_actuel - $montant;
        }

        // On met à jour le solde du compte
        $compteModel->id = $compte_id;
        $compteModel->updateSolde($nouveau_solde);

        $msg = $type === 'depot' ? 'Dépôt+effectué+avec+succès' : 'Retrait+effectué+avec+succès';
        header('Location: /index.php?action=transactions_index&compte_id=' . $compte_id . '&message=' . $msg . '&type=success');
        exit;
    }
}