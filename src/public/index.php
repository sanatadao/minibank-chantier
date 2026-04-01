<?php
// ROUTEUR PRINCIPAL

// --- Chargement config DB ---
require_once __DIR__ . "/../config/database.php";
$db = new Database();
$pdo = $db->getConnection();


// --- Chargement des models ---
require_once __DIR__ . "/../models/clientsModel.php";
require_once __DIR__ . "/../models/comptesModel.php";
require_once __DIR__ . "/../models/transactionsModel.php";

// --- Chargement des controllers ---
require_once __DIR__ . "/../controllers/clientsController.php";
require_once __DIR__ . "/../controllers/comptesController.php";
require_once __DIR__ . "/../controllers/transactionsController.php";

// --- Instanciation des controllers ---
$clientController = new ClientController($pdo);
$compteController = new CompteController($pdo);
$transactionController = new TransactionController($pdo);

// --- Routing ---
$action = $_GET["action"] ?? "home";

switch ($action) {

    case "home":
        include __DIR__ . "/../views/home.php";
        break;

    // CLIENTS
    case "clients":
        $clientController->index();
        break;

    case "client_create":
        $clientController->create();
        break;

    case "client_store":
        $clientController->store();
        break;

    case "client_edit":
        $clientController->edit($_GET["id"]);
        break;

    case "client_update":
        $clientController->update($_GET["id"]);
        break;

    case "client_delete_confirm":
        $clientController->confirmDelete($_GET["id"]);
        break;

    case "client_delete":
        $clientController->delete($_GET["id"]);
        break;

    // COMPTES
    case "comptes":
        $compteController->index();
        break;

    case "compte_create":
        $compteController->create();
        break;

    case "compte_store":
        $compteController->store();
        break;

    case "compte_delete":
        $compteController->delete($_GET["id"]);
        break;

    // TRANSACTIONS
    case "transactions":
        $transactionController->index($_GET["id"]);
        break;

    case "transaction_create":
        $transactionController->create($_GET["id"]);
        break;

    case "transaction_store":
        $transactionController->store($_GET["id"]);
        break;

    default:
        echo "Action inconnue.";
}