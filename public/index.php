<?php
// Habilitar errores (solo para desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

// CARGA MANUAL DE ARCHIVOS
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/models/User.php';
require_once __DIR__ . '/../src/models/Task.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/controllers/TaskController.php';

// Obtener la acción
$action = $_GET['action'] ?? 'login';

// Conectar a la base de datos
$database = new Database();
$db = $database->getConnection();

// Router simple
switch($action) {
    case 'login':
        $controller = new AuthController($db);
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;
        
    case 'register':
        $controller = new AuthController($db);
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->showRegister();
        }
        break;
        
    case 'logout':
        $controller = new AuthController($db);
        $controller->logout();
        break;
        
    case 'tasks':
        $controller = new TaskController($db);
        $controller->index();
        break;
        
    case 'create-task':
        $controller = new TaskController($db);
        $controller->create();
        break;
        
    case 'edit-task':
        $controller = new TaskController($db);
        $controller->edit();
        break;
        
    case 'delete-task':
        $controller = new TaskController($db);
        $controller->delete();
        break;
        
    default:
        header('Location: /index.php?action=login');
        exit();
}
