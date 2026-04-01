CREATE TABLE transactions (
    id INT NOT NULL AUTO_INCREMENT,
    type ENUM('depot','retrait') NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    compte_id INT DEFAULT NULL,
    PRIMARY KEY (id),
    KEY fk_compte (compte_id),
    CONSTRAINT fk_compte FOREIGN KEY (compte_id) REFERENCES comptes (id) ON DELETE CASCADE
);