<?php

class Transaction {
    private $conn;
    private $table_name = "transactions";

    public $id = null;
    public $type;
    public $montant;
    public $compte_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lire toutes les transactions d'un compte OU une seule
    public function read($id = null) {
        if ($id === null) {
            return []; // pas de "read all" global dans ce projet
        } else {
            $query = "SELECT * FROM " . $this->table_name . "
                      WHERE compte_id = :id ORDER BY date ASC";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Créer une transaction
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET type = :type, montant = :montant, compte_id = :compte_id";

        $stmt = $this->conn->prepare($query);

        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->montant = htmlspecialchars(strip_tags($this->montant));
        $this->compte_id = htmlspecialchars(strip_tags($this->compte_id));

        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":montant", $this->montant);
        $stmt->bindParam(":compte_id", $this->compte_id);

        return $stmt->execute();
    }
}