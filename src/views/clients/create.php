<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un client</title>
</head>
<body>
    <h1>Créer un client</h1>

    <nav>
        <a href="index.php?action=clients">Retour à la liste</a>
    </nav>

    <form method="POST" action="index.php?action=client_store" onsubmit="return validateForm()">
        <p>
            <label>Nom :</label><br>
            <input type="text" name="nom" required>
        </p>

        <p>
            <label>Prénom :</label><br>
            <input type="text" name="prenom" required>
        </p>

        <p>
            <label>Email :</label><br>
            <input type="email" name="email" required>
        </p>

        <p>
            <label>Ville :</label><br>
            <input type="text" name="ville">
        </p>

        <button type="submit">Créer</button>
    </form>

    <script>
    function validateForm() {
        let email = document.querySelector("input[name='email']").value;
        if (!email.includes("@")) {
            alert("Email invalide");
            return false;
        }
        return true;
    }
    </script>
</body>
</html>