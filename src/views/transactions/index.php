<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBank — Transactions</title>
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
            <h1>Historique des <span>Transactions</span></h1>
            <a href="index.php?action=comptes" class="btn btn-secondary">← Retour aux comptes</a>
        </div>

        <!-- Message succès ou erreur -->
        <?php if (!empty($_GET['message'])): ?>
            <div class="alert alert-<?= htmlspecialchars($_GET['type'] ?? 'success') ?>">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Infos du compte -->
        <div class="card" style="display:flex; align-items:center; gap:2rem; flex-wrap:wrap; margin-bottom:1.25rem;">
            <div>
                <p style="font-size:0.82rem; color:#667085; margin-bottom:2px;">Compte</p>
                <p style="font-size:1.05rem; font-weight:600;">
                    <?= htmlspecialchars($dataCompte['numero_compte']) ?>
                </p>
            </div>
            <div>
                <p style="font-size:0.82rem; color:#667085; margin-bottom:2px;">Titulaire</p>
                <p style="font-size:1.05rem; font-weight:600;">
                    <?= htmlspecialchars($dataCompte['nom'] . ' ' . $dataCompte['prenom']) ?>
                </p>
            </div>
            <div>
                <p style="font-size:0.82rem; color:#667085; margin-bottom:2px;">Solde actuel</p>
                <!-- data-solde utilisé par le JS bonus pour l'indicateur -->
                <p id="solde-courant"
                   data-solde="<?= $dataCompte['solde'] ?>"
                   style="font-size:1.2rem; font-weight:700; color:#12b76a;">
                    <?= number_format($dataCompte['solde'], 2, ',', ' ') ?> €
                </p>
            </div>
        </div>

        <!-- Formulaire nouvelle transaction -->
        <div class="card" style="max-width: 480px; margin-bottom: 2rem;">

            <h2 style="font-size: 1.05rem; font-weight: 600; margin-bottom: 1.25rem;">
                Nouvelle transaction
            </h2>

            <form method="POST"
                  action="index.php?action=transaction_store&id=<?= $dataCompte['id'] ?>"
                  data-validate="transaction">

                <!-- Id du compte envoyé en caché -->
                <input type="hidden" name="compte_id" value="<?= $dataCompte['id'] ?>">

                <div class="form-group">
                    <label for="type">Type <span class="required">*</span></label>
                    <select id="type" name="type">
                        <option value="">-- Choisir --</option>
                        <option value="depot">💰 Dépôt</option>
                        <option value="retrait">💸 Retrait</option>
                    </select>
                    <span class="field-error"></span>
                </div>

                <div class="form-group">
                    <label for="montant">Montant (€) <span class="required">*</span></label>
                    <input type="number" id="montant" name="montant"
                           placeholder="Ex : 100.00" min="0.01" step="0.01">
                    <span class="field-error"></span>
                </div>

                <!-- Indicateur solde bonus JS -->
                <div id="solde-indicateur" style="display:none; margin-bottom:1rem;"></div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">✓ Valider la transaction</button>
                </div>

            </form>

        </div>

        <!-- Historique des transactions -->
        <div class="card">

            <h2 style="font-size: 1.05rem; font-weight: 600; margin-bottom: 1.25rem;">
                Historique
            </h2>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Montant</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="3" style="text-align:center; color:#667085; padding:2rem;">
                                    Aucune transaction pour ce compte.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($transactions as $t): ?>
                            <tr>
                                <td>
                                    <?php if ($t['type'] === 'depot'): ?>
                                        <span class="badge badge-vert">💰 Dépôt</span>
                                    <?php else: ?>
                                        <span class="badge badge-rouge">💸 Retrait</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-weight:600; color:<?= $t['type'] === 'depot' ? '#12b76a' : '#f04438' ?>;">
                                    <?= $t['type'] === 'depot' ? '+' : '-' ?>
                                    <?= number_format($t['montant'], 2, ',', ' ') ?> €
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($t['date'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

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