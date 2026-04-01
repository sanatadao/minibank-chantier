<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniBank</title>
</head>
<body>
    <header>
        MiniBank
    </header>
    <nav>
        <ul>
            <li> <a href="/index.php?action=clients_index" >Clients</a></li>
            <li> <a href="/index.php?action=comptes_index">Comptes</a></li>
            <li> <a href="/index.php?action=transactions_index">Transactions</a></li>
        </ul>
    </nav>
    <main>
        <?php 
        echo $content;
        
        ?>
    </main>
</body>
</html>