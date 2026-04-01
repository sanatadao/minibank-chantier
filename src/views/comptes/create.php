<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
</head>
<body>
    <h1>Créer un compte</h1>

    <nav>
        <a href="index.php?action=comptes">Retour à la liste</a>
    </nav>

    <form method="POST" action="index.php?action=compte_store">
        <p>
            <label>Numéro de compte :</label><br>
            <input type="text" name="numero_compte" required>
        </p>

        <p>
            <label>Solde initial :</label><br>
            <input type="number" name="solde" step="0.01" required>
        </p>

        <p>
            <label>Client :</label><br>
            <select name="client_id" required>
                <?php foreach ($clients as $c): ?>
                    <option value="<?= $c['id'] ?>">
                        <?= htmlspecialchars($c['nom'] . " " . $c['prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <button type="submit">Créer</button>
    </form>
</body>
</html>