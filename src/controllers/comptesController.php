<?php
require_once __DIR__ . "/../models/comptesModel.php";
require_once __DIR__ . "/../models/clientsModel.php";

class CompteController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $compte = new Compte($this->db);
        $comptes = $compte->read();

        $client = new Client($this->db); 
        $clients = $client->read();

        include __DIR__ . "/../views/comptes/index.php";
    }

    public function create() {
        $client = new Client($this->db);
        $clients = $client->read();

        include __DIR__ . "/../views/comptes/create.php";
    }

    public function store() {
        $compte = new Compte($this->db);

        $compte->numero_compte = $_POST["numero_compte"];
        $compte->solde = $_POST["solde"];
        $compte->client_id = $_POST["client_id"];

        if ($compte->create()) {
            header("Location: index.php?action=comptes");
        } else {
            echo "Erreur lors de la création du compte.";
        }
    }

    public function delete($id) {
        $compte = new Compte($this->db);
        $compte->id = $id;

        if (!$compte->delete()) {
            echo "Impossible de supprimer : des transactions existent.";
            return;
        }

        header("Location: index.php?action=comptes");
    }
}