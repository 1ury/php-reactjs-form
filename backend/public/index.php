<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");

// Handle OPTIONS requests for CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}
require_once(__DIR__ . '/../config/database.php');
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/api/produtos' :
        require_once(__DIR__ . '/../api/ProdutoController.php');
        break;
    case '/api/tipos' :
        require_once(__DIR__ . '/../api/TipoController.php');
        break;
    case '/api/vendas' :
        require_once(__DIR__ . '/../api/VendaController.php');
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Rota não encontrada']);
        break;
}
?>
