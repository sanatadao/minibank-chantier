<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un client</title>
</head>
<body>
    <h1>Supprimer un client</h1>

    <nav>
        <a href="index.php?action=clients">Retour à la liste</a>
    </nav>

    <p>Voulez-vous vraiment supprimer ce client ?</p>

    <ul>
        <li><strong>Nom :</strong> <?= htmlspecialchars($data["nom"]) ?></li>
        <li><strong>Prénom :</strong> <?= htmlspecialchars($data["prenom"]) ?></li>
        <li><strong>Email :</strong> <?= htmlspecialchars($data["email"]) ?></li>
    </ul>

    <form method="POST" action="index.php?action=client_delete&id=<?= $data['id'] ?>">
        <button type="submit" onclick="return confirm('Confirmer la suppression ?')">Oui, supprimer</button>
        <a href="index.php?action=clients">Annuler</a>
    </form>
</body>
</html>