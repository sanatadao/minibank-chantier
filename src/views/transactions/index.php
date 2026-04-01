<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des transactions</title>
</head>
<body>
    <h1>Historique du compte <?= htmlspecialchars($dataCompte["numero_compte"]) ?></h1>

    <nav>
        <a href="index.php?action=comptes">Retour aux comptes</a>
    </nav>

    <p>Solde actuel : <strong><?= htmlspecialchars($dataCompte["solde"]) ?> €</strong></p>

    <p>
        <a href="index.php?action=transaction_create&id=<?= $dataCompte['id'] ?>">Nouvelle opération</a>
    </p>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Type</th>
            <th>Montant</th>
            <th>Date</th>
        </tr>

        <?php foreach ($transactions as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t["type"]) ?></td>
            <td><?= htmlspecialchars($t["montant"]) ?> €</td>
            <td><?= htmlspecialchars($t["date"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>