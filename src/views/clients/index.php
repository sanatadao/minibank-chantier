<?php ob_start();
// php/clients/index.php
// Rôle : Afficher la liste des clients
//        (les données sont fournies par le controller)

// $clients est fourni par ClientController->index()
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MiniBank — Liste des Clients</title>
    <link rel="stylesheet" href="../../front_end/style.css">
</head>
<body>

<nav>
    <a href="../../front_end/index.html" class="nav-logo">Mini<span>Bank</span></a>
    <ul class="nav-links">
        <li><a href="/index.php?action=clients_index" class="active">Clients</a></li>
        <li><a href="/index.php?action=comptes_index">Comptes</a></li>
        <li><a href="/index.php?action=transactions_index">Transactions</a></li>
    </ul>
</nav>

<main>

    <div class="page-header">
        <h1>Liste des <span>Clients</span></h1>
        <a href="/index.php?action=clients_create" class="btn btn-primary">+ Ajouter un client</a>
    </div>

    <?php if (!empty($_GET['message'])): ?>
        <div class="alert <?= htmlspecialchars($_GET['type'] ?? 'info') ?>">
            <?= htmlspecialchars($_GET['message']) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client["nom"]) ?></td>
                        <td><?= htmlspecialchars($client["prenom"]) ?></td>
                        <td><?= htmlspecialchars($client["email"]) ?></td>
                        <td><?= htmlspecialchars($client["ville"]) ?></td>

                        <td>
                            <a href="/index.php?action=clients_edit&id=<?= $client["id"] ?>" class="btn btn-small">
                                Modifier
                            </a>

                            <a href="/index.php?action=clients_delete&id=<?= $client["id"] ?>"
                               class="btn btn-danger btn-small"
                               onclick="return confirm('Supprimer ce client ?');">
                               Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

<footer>MiniBank © 2026 — Projet scolaire</footer>

<script src="../../front_end/app.js"></script>
</body>
</html>
<?php $content=ob_get_clean(); ?>
<?php include __DIR__ . "/../layout.php"; ?>