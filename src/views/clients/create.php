<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBank — Ajouter un client</title>
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
            <h1>Ajouter un <span>Client</span></h1>
            <a href="index.php?action=clients" class="btn btn-secondary">← Retour</a>
        </div>

        <div class="card" style="max-width: 600px;">

            <form method="POST" action="index.php?action=client_store" data-validate="client">

                <!-- Nom et Prénom côte à côte -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom <span class="required">*</span></label>
                        <input type="text" id="nom" name="nom" placeholder="Ex : Dupont">
                        <span class="field-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom <span class="required">*</span></label>
                        <input type="text" id="prenom" name="prenom" placeholder="Ex : Marie">
                        <span class="field-error"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" placeholder="Ex : marie@mail.com">
                    <span class="field-error"></span>
                </div>

                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" id="ville" name="ville" placeholder="Ex : Paris">
                </div>

                <div class="form-actions">
                    <a href="index.php?action=clients" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">✓ Enregistrer</button>
                </div>

            </form>

        </div>

    </main>

    <footer>
        <p>MiniBank &copy; 2026 — Projet scolaire</p>
    </footer>

    <!-- Modale de confirmation (obligatoire pour app.js) -->
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