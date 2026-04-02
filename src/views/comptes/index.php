<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBank — Comptes</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <!-- NAVIGATION -->
    <nav>
        <a href="index.php?action=home" class="nav-logo">Mini<span>Bank</span></a>
        <ul class="nav-links">
            <li><a href="index.php?action=clients" class="nav-link">Clients</a></li>
            <li><a href="index.php?action=comptes" class="nav-link active">Comptes</a></li>
        </ul>
    </nav>

    <!-- CONTENU -->
    <main>

        <div class="page-header">
            <h1>Comptes <span>Bancaires</span></h1>
        </div>

        <!-- Message succès ou erreur -->
        <?php if (!empty($_GET['message'])): ?>
            <div class="alert alert-<?= htmlspecialchars($_GET['type'] ?? 'success') ?>">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Tableau des comptes -->
        <div class="card">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Numéro de compte</th>
                            <th>Titulaire</th>
                            <th>Solde</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comptes as $c): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($c['numero_compte']) ?></strong></td>
                            <td><?= htmlspecialchars($c['nom'] . ' ' . $c['prenom']) ?></td>
                            <td>
                                <!-- Badge vert si solde positif, rouge sinon -->
                                <span class="badge <?= $c['solde'] > 0 ? 'badge-vert' : 'badge-rouge' ?>">
                                    <?= number_format($c['solde'], 2, ',', ' ') ?> €
                                </span>
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="index.php?action=transactions&id=<?= $c['id'] ?>"
                                       class="btn btn-primary btn-sm">📋 Transactions</a>
                                    <a href="index.php?action=compte_delete&id=<?= $c['id'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Supprimer ce compte ?')">🗑 Supprimer</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Formulaire de création d'un compte -->
        <div class="card" style="max-width: 500px;">

            <h2 style="font-size: 1.05rem; font-weight: 600; margin-bottom: 1.25rem;">
                ➕ Créer un nouveau compte
            </h2>

            <form method="POST" action="index.php?action=compte_store" data-validate="compte">

                <div class="form-group">
                    <label for="numero_compte">Numéro de compte <span class="required">*</span></label>
                    <input type="text" id="numero_compte" name="numero_compte"
                           placeholder="Ex : FR76-0005-0001">
                    <span class="field-error"></span>
                </div>

                <div class="form-group">
                    <label for="client_id">Client associé <span class="required">*</span></label>
                    <select id="client_id" name="client_id">
                        <option value="">-- Choisir un client --</option>
                        <?php foreach ($clients as $c): ?>
                            <option value="<?= $c['id'] ?>">
                                <?= htmlspecialchars($c['nom'] . ' ' . $c['prenom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="field-error"></span>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">✓ Créer le compte</button>
                </div>

            </form>

        </div>

    </main>

    <footer>
        <p>MiniBank &copy; 2026 — Projet scolaire</p>
    </footer>

    <div id="modal-overlay" class="modal-overlay">
        <div class="modal-box">
            <h2>⚠ Confirmer la suppression</h2>
            <p id="modal-message"></p>
            <div class="modal-actions">
                <button id="btn-cancel-delete" class="btn btn-secondary">Annuler</button>
                <button id="btn-confirm-delete" class="btn btn-danger">Oui, supprimer</button>
            </div>
        </div>
    </div>

    <script src="/js/app.js"></script>

</body>
</html>