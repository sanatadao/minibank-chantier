<?php

class Client {
    private $conn; //connexion à la base de données
    private $table_name = "clients"; //table clients

    public $id = null; 
    public $nom;
    public $prenom;
    public $email;
    public $ville = null; //champ optionnel

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lire tous les clients OU un seul si id fourni
    public function read($id = null) {
        if ($id === null) {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY nom, prenom";
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    // Créer un client
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET nom = :nom, prenom = :prenom, email = :email, ville = :ville";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->email = htmlspecialchars(strip_tags($this->email));
        if ($this->ville !== null) {
            $this->ville = htmlspecialchars(strip_tags($this->ville));
        }

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":ville", $this->ville);

        return $stmt->execute();
    }

    // Modifier un client
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET nom = :nom, prenom = :prenom, email = :email, ville = :ville
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->email = htmlspecialchars(strip_tags($this->email));
        if ($this->ville !== null) {
            $this->ville = htmlspecialchars(strip_tags($this->ville));
        }
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":ville", $this->ville);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Supprimer un client
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}