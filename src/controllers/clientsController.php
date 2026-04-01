<?php

include_once '../config/database.php';
include_once '../models/clientsModel.php';

class ClientController {
    private $conn;
    private $client;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->client = new Client($this->conn);
    }

    // Afficher la liste des clients
    public function index() {
        $stmt = $this->client->read();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include '../views/clients/index.php';
    }

     // 2. Formulaire d'ajout
    public function create() {
        include '../views/clients/add.php';
    }

    // 3. Traitement de l'ajout
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php?action=clients_index');
            exit;
        }

        $this->client->nom    = trim($_POST['nom']);
        $this->client->prenom = trim($_POST['prenom']);
        $this->client->email  = trim($_POST['email']);
        $this->client->ville  = trim($_POST['ville']);

        $this->client->create();

        header('Location: /index.php?action=clients_index&message=Client+ajouté&type=success');
        exit;
    }

    // 4. Formulaire de modification
    public function edit($id) {
        $client = $this->client->read($id);
        include '../views/clients/edit.php';
    }

    // 5. Traitement de la modification
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php?action=clients_index');
            exit;
        }

        $this->client->id     = $id;
        $this->client->nom    = trim($_POST['nom']);
        $this->client->prenom = trim($_POST['prenom']);
        $this->client->email  = trim($_POST['email']);
        $this->client->ville  = trim($_POST['ville']);

        $this->client->update();

        header('Location: /index.php?action=clients_index&message=Client+modifié&type=success');
        exit;
    }

    // 6. Suppression
    public function delete($id) {
        $this->client->id = $id;
        $this->client->delete();

        header('Location: /index.php?action=clients_index&message=Client+supprimé&type=success');
        exit;
    }


}