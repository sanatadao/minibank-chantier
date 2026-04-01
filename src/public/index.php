<?php
// =============================================
// public/index.php
// Rôle : Router principal du projet MiniBank
//        Dirige chaque action vers le bon controller
// =============================================

// Chargement des controllers
require_once '../controllers/clientsController.php';
// (Tu ajouteras ici ComptesController, TransactionsController plus tard)

// Lecture de l'action dans l'URL
$action = $_GET['action'] ?? 'home';

// Router
switch ($action) {

    case 'clients_index':
        $controller = new ClientController();
        $controller->index();
        break;
    
    case 'clients_create':
        $controller = new ClientController();
        $controller->create();
        break;

    default:
        echo 'Page non trouvée.';
        break;
}

