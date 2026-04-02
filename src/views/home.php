<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBank — Accueil</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <!-- NAVIGATION -->
    <nav>
        <a href="index.php?action=home" class="nav-logo">Mini<span>Bank</span></a>
        <ul class="nav-links">
            <li><a href="index.php?action=clients" class="nav-link">Clients</a></li>
            <li><a href="index.php?action=comptes" class="nav-link">Comptes</a></li>
        </ul>
    </nav>

    <!-- CONTENU -->
    <main>

        <!-- Bandeau de bienvenue -->
        <div class="hero">
            <h1>Bienvenue sur <span>MiniBank</span></h1>
            <p>Gérez vos clients, comptes et transactions en toute simplicité.</p>
        </div>

        <!-- Les 2 cartes cliquables -->
        <div class="nav-cards">
            <a href="index.php?action=clients" class="nav-card">
                <div class="icon">👥</div>
                <h2>Clients</h2>
                <p>Consultez et gérez la liste des clients.</p>
            </a>
            <a href="index.php?action=comptes" class="nav-card">
                <div class="icon">💳</div>
                <h2>Comptes</h2>
                <p>Visualisez les comptes et leurs soldes.</p>
            </a>
        </div>

    </main>

    <footer>
        <p>MiniBank &copy; 2026 — Projet scolaire</p>
    </footer>

</body>
</html>