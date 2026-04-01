<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un client</title>
</head>
<body>
    <h1>Modifier un client</h1>

    <nav>
        <a href="index.php?action=clients">Retour à la liste</a>
    </nav>

    <form method="POST" action="index.php?action=client_update&id=<?= $data['id'] ?>">
        <p>
            <label>Nom :</label><br>
            <input type="text" name="nom" value="<?= htmlspecialchars($data['nom']) ?>" required>
        </p>

        <p>
            <label>Prénom :</label><br>
            <input type="text" name="prenom" value="<?= htmlspecialchars($data['prenom']) ?>" required>
        </p>

        <p>
            <label>Email :</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
        </p>

        <p>
            <label>Ville :</label><br>
            <input type="text" name="ville" value="<?= htmlspecialchars($data['ville']) ?>">
        </p>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>