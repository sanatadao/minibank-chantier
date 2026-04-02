<?php

class Compte {
    private $conn;
    private $table_name = "comptes";

    public $id = null;
    public $numero_compte;
    public $solde = 0.00; //valeur pas défaut
    public $client_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lire tous les comptes OU un seul
    public function read($id = null) {
        if ($id === null) {
            $query = "SELECT comptes.id, comptes.numero_compte, comptes.solde, comptes.client_id,
                             clients.nom, clients.prenom
                      FROM " . $this->table_name . "
                      JOIN clients ON comptes.client_id = clients.id
                      ORDER BY comptes.numero_compte";

            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } else {
            $query = "SELECT comptes.*, clients.nom, clients.prenom
              FROM " . $this->table_name . "
              JOIN clients ON comptes.client_id = clients.id
              WHERE comptes.id = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    // Créer un compte
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET numero_compte = :numero_compte, solde = :solde, client_id = :client_id";

        $stmt = $this->conn->prepare($query);

        $this->numero_compte = htmlspecialchars(strip_tags($this->numero_compte));
        $this->solde = htmlspecialchars(strip_tags($this->solde));
        $this->client_id = htmlspecialchars(strip_tags($this->client_id));

        $stmt->bindParam(":numero_compte", $this->numero_compte);
        $stmt->bindParam(":solde", $this->solde);
        $stmt->bindParam(":client_id", $this->client_id);

        return $stmt->execute();
    }
    
    // Mettre à jour le solde
    public function updateSolde($nouveauSolde) {
        $query = "UPDATE " . $this->table_name . " SET solde = :solde WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":solde", $nouveauSolde);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Vérifier si un compte a des transactions
    public function hasTransactions() {
        $query = "SELECT COUNT(*) AS total FROM transactions WHERE compte_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["total"] > 0;
    }

    // Supprimer un compte
    public function delete() {
        if ($this->hasTransactions()) {
            return false;
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    
}