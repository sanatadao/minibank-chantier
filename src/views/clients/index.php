<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBank — Liste des clients</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <!-- NAVIGATION -->
    <nav>
        <a href="index.php?action=home" class="nav-logo">Mini<span>Bank</span></a>
        <ul class="nav-links">
            <li><a href="index.php?action=clients" class="nav-link active">Clients</a></li>
            <li><a href="index.php?action=comptes" class="nav-link">Comptes</a></li>
        </ul>
    </nav>

    <!-- CONTENU -->
    <main>

        <!-- Titre + bouton ajouter -->
        <div class="page-header">
            <h1>Liste des <span>Clients</span></h1>
            <a href="index.php?action=client_create" class="btn btn-primary">+ Ajouter un client</a>
        </div>

        <!-- Message succès ou erreur -->
        <?php if (!empty($_GET['message'])): ?>
            <div class="alert alert-<?= htmlspecialchars($_GET['type'] ?? 'success') ?>">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Carte contenant la recherche et le tableau -->
        <div class="card">

            <!-- Barre de recherche -->
            <div class="search-bar">
                <span class="search-icon">🔍</span>
                <input type="text" id="search" placeholder="Rechercher un client...">
            </div>

            <!-- Tableau des clients -->
            <div class="table-wrapper">
                <table>
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
                        <?php foreach ($clients as $c): ?>
                        <tr class="client-row">
                            <td><?= htmlspecialchars($c['nom']) ?></td>
                            <td><?= htmlspecialchars($c['prenom']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= htmlspecialchars($c['ville'] ?? '-') ?></td>
                            <td>
                                <div class="actions-cell">
                                    <a href="index.php?action=client_edit&id=<?= $c['id'] ?>"
                                       class="btn btn-secondary btn-sm">✏ Modifier</a>
                                    <a href="index.php?action=client_delete_confirm&id=<?= $c['id'] ?>"
                                       class="btn btn-danger btn-sm">🗑 Supprimer</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </main>

    <footer>
        <p>MiniBank &copy; 2026 — Projet scolaire</p>
    </footer>

    <!-- Filtre de recherche JS -->
    <script>
    document.getElementById('search').addEventListener('input', function() {
        let filtre = this.value.toLowerCase();
        document.querySelectorAll('.client-row').forEach(function(ligne) {
            ligne.style.display = ligne.textContent.toLowerCase().includes(filtre) ? '' : 'none';
        });
    });
    </script>

</body>
</html>