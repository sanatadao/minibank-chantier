<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des clients</title>
</head>
<body>
    <h1>Clients</h1>

    <nav>
        <a href="index.php?action=home">Accueil</a> |
        <a href="index.php?action=comptes">Comptes</a>
    </nav>

    <h2>Liste des clients</h2>

    <input type="text" id="search" placeholder="Rechercher un client..." />

    <p><a href="index.php?action=client_create">Ajouter un client</a></p>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Ville</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($clients as $c): ?>
        <tr class="client-row">
            <td><?= htmlspecialchars($c["nom"]) ?></td>
            <td><?= htmlspecialchars($c["prenom"]) ?></td>
            <td><?= htmlspecialchars($c["email"]) ?></td>
            <td><?= htmlspecialchars($c["ville"]) ?></td>
            <td>
                <a href="index.php?action=client_edit&id=<?= $c['id'] ?>">Modifier</a> |
                <a href="index.php?action=client_delete_confirm&id=<?= $c['id'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
    document.getElementById("search").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll(".client-row").forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(filter) ? "" : "none";
        });
    });
    </script>
</body>
</html>