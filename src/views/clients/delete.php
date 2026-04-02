<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBank — Supprimer un client</title>
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

        <div class="page-header">
            <h1>Supprimer un <span>Client</span></h1>
            <a href="index.php?action=clients" class="btn btn-secondary">← Retour</a>
        </div>

        <div class="card" style="max-width: 500px;">

            <!-- Message de confirmation -->
            <div class="alert alert-error" style="margin-bottom: 1.5rem;">
                ⚠ Voulez-vous vraiment supprimer ce client ? Cette action est irréversible.
            </div>

            <!-- Infos du client à supprimer -->
            <p style="margin-bottom: 0.5rem;">
                <strong>Nom :</strong> <?= htmlspecialchars($data['nom']) ?>
            </p>
            <p style="margin-bottom: 0.5rem;">
                <strong>Prénom :</strong> <?= htmlspecialchars($data['prenom']) ?>
            </p>
            <p style="margin-bottom: 1.5rem;">
                <strong>Email :</strong> <?= htmlspecialchars($data['email']) ?>
            </p>

            <!-- Boutons -->
            <form method="POST" action="index.php?action=client_delete&id=<?= $data['id'] ?>">
                <div class="form-actions">
                    <a href="index.php?action=clients" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-danger">🗑 Oui, supprimer</button>
                </div>
            </form>

        </div>

    </main>

    <footer>
        <p>MiniBank &copy; 2026 — Projet scolaire</p>
    </footer>

</body>
</html>