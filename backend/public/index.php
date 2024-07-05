<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/api/produtos' :
        require __DIR__ . '/../api/ProdutoController.php';
        break;
    case '/api/tipos' :
        require __DIR__ . '/../api/TipoController.php';
        break;
    case '/api/vendas' :
        require __DIR__ . '/../api/VendaController.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Rota não encontrada']);
        break;
}
?>
