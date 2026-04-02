<?php
require_once __DIR__ . "/../models/clientsModel.php";

class ClientController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $client = new Client($this->db);
        $clients = $client->read();

        include __DIR__ . "/../views/clients/index.php";

    }

    public function create() {
        include __DIR__ . "/../views/clients/create.php";

    }

    public function store() {
        $client = new Client($this->db);

        $client->nom = $_POST["nom"];
        $client->prenom = $_POST["prenom"];
        $client->email = $_POST["email"];
        $client->ville = $_POST["ville"] ?? null;

        if ($client->create()) {
            header("Location: index.php?action=clients");
            exit();
        }
        echo "Erreur lors de la création du client.";
    }

    public function edit($id) {
        $client = new Client($this->db);
        $data = $client->read($id);

        include __DIR__ . "/../views/clients/edit.php";

    }

    public function update($id) {
        $client = new Client($this->db);

        $client->id = $id;
        $client->nom = $_POST["nom"];
        $client->prenom = $_POST["prenom"];
        $client->email = $_POST["email"];
        $client->ville = $_POST["ville"] ?? null;

        $client->update();
        header("Location: index.php?action=clients");
    }

    public function confirmDelete($id) {
        $client = new Client($this->db);
        $data = $client->read($id);

        include __DIR__ . "/../views/clients/delete.php";

    }

    public function delete($id) {
        $client = new Client($this->db);
        $client->id = $id;

        $client->delete();
        header("Location: index.php?action=clients");
    }
}