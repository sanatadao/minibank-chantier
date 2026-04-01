<?php
require_once __DIR__ . "/../models/transactionsModel.php";
require_once __DIR__ . "/../models/comptesModel.php";

class TransactionController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index($compte_id) {
        $transaction = new Transaction($this->db);
        $transactions = $transaction->read($compte_id);

        $compte = new Compte($this->db);
        $dataCompte = $compte->read($compte_id);

        include __DIR__ . "/../views/transactions/index.php";
    }

    public function create($compte_id) {
        include __DIR__ . "/../views/transactions/create.php";
    }

    public function store($compte_id) {
        $compte = new Compte($this->db);
        $compte->id = $compte_id;
        $data = $compte->read($compte_id);

        $type = $_POST["type"];
        $montant = floatval($_POST["montant"]);

        if ($type === "retrait" && $montant > $data["solde"]) {
            echo "Solde insuffisant !";
            return;
        }

        $transaction = new Transaction($this->db);
        $transaction->type = $type;
        $transaction->montant = $montant;
        $transaction->compte_id = $compte_id;

        if ($transaction->create()) {
            $nouveauSolde = $type === "depot"
                ? $data["solde"] + $montant
                : $data["solde"] - $montant;

            $compte->updateSolde($nouveauSolde);

            header("Location: index.php?action=transactions&id=$compte_id");
        } else {
            echo "Erreur lors de l'opération.";
        }
    }
}