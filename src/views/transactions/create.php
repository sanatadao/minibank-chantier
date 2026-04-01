<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle transaction</title>
</head>
<body>
    <h1>Nouvelle transaction</h1>

    <nav>
        <a href="index.php?action=transactions&id=<?= $compte_id ?>">Retour à l'historique</a>
    </nav>

    <form method="POST" action="index.php?action=transaction_store&id=<?= $compte_id ?>" onsubmit="return validateMontant()">
        <p>
            <label>Type :</label><br>
            <select name="type">
                <option value="depot">Dépôt</option>
                <option value="retrait">Retrait</option>
            </select>
        </p>

        <p>
            <label>Montant :</label><br>
            <input type="number" name="montant" step="0.01" min="0.01" required>
        </p>

        <button type="submit">Valider</button>
    </form>

    <script>
    function validateMontant() {
        let montant = parseFloat(document.querySelector("input[name='montant']").value);
        if (isNaN(montant) || montant <= 0) {
            alert("Le montant doit être supérieur à 0.");
            return false;
        }
        return true;
    }
    </script>
</body>
</html>