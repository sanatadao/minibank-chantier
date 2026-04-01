<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des comptes</title>
</head>
<body>
    <h1>Comptes</h1>

    <nav>
        <a href="index.php?action=home">Accueil</a> |
        <a href="index.php?action=clients">Clients</a>
    </nav>

    <h2>Liste des comptes</h2>

    <p><a href="index.php?action=compte_create">Créer un compte</a></p>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Numéro</th>
            <th>Solde</th>
            <th>Client</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($comptes as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c["numero_compte"]) ?></td>
            <td><?= htmlspecialchars($c["solde"]) ?> €</td>
            <td><?= htmlspecialchars($c["nom"] . " " . $c["prenom"]) ?></td>
            <td>
                <a href="index.php?action=transactions&id=<?= $c['id'] ?>">Historique</a> |
                <a href="index.php?action=compte_delete&id=<?= $c['id'] ?>"
                   onclick="return confirm('Supprimer ce compte ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>