-- Clients
INSERT INTO clients (nom, prenom, email, ville) VALUES
('Gentil', 'Petit', 'gentil.petit@gmail.com', 'Paris'),
('Damido', 'Valerie', 'valerie@gmail.com', 'Versailles'),
('Knowles', 'Beyonce', 'Beyonce@hotmail.com', 'Los Angeles'),
('Poulain', 'Amlie', 'poulain@yahoo.fr', 'Vienne');

-- Comptes
INSERT INTO comptes (numero_compte, solde, client_id) VALUES
('FR1234567890', 5.20, 1),
('FR0987654321', 50000.46, 2),
('FR987654876321', 5000000.10, 3),
('FR1122334455', 100.00, 4);

-- Transactions
INSERT INTO transactions (type, montant, compte_id) VALUES
('depot', 200.00, 1),
('retrait', 50.00, 2),
('depot', 2000.00, 3),
('depot', 100.00, 4);