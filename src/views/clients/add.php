<?php

// php/clients/add.php
// Rôle : Afficher le formulaire d'ajout/modification
//        (les données sont fournies par le controller)

// $client est fourni par ClientController->edit($id)
// S'il est null → mode ajout
$isEdit = isset($client);
$titre = $isEdit ? "Modifier le Client" : "Ajouter un Client";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MiniBank — <?= htmlspecialchars($titre) ?></title>
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
        <h1><?= $isEdit ? "Modifier le" : "Ajouter un" ?> <span>Client</span></h1>
        <a href="/index.php?action=clients_index" class="btn btn-secondary">← Retour</a>
    </div>

    <div class="card" style="max-width: 600px;">

        <form method="POST"
              action="/index.php?action=<?= $isEdit ? 'clients_update&id=' . $client['id'] : 'clients_store' ?>"
              data-validate="client">

            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom <span class="required">*</span></label>
                    <input type="text"
                           id="nom"
                           name="nom"
                           value="<?= htmlspecialchars($client['nom'] ?? '') ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom <span class="required">*</span></label>
                    <input type="text"
                           id="prenom"
                           name="prenom"
                           value="<?= htmlspecialchars($client['prenom'] ?? '') ?>"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email"
                       id="email"
                       name="email"
                       value="<?= htmlspecialchars($client['email'] ?? '') ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text"
                       id="ville"
                       name="ville"
                       value="<?= htmlspecialchars($client['ville'] ?? '') ?>">
            </div>

            <div class="form-actions">
                <a href="/index.php?action=clients_index" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <?= $isEdit ? "✓ Enregistrer les modifications" : "✓ Enregistrer" ?>
                </button>
            </div>

        </form>

    </div>

</main>

<footer>MiniBank © 2026 — Projet scolaire</footer>

<script src="../../front_end/app.js"></script>
</body>
</html>