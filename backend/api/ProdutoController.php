<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/Produto.php');

$produto = new Produto($pdo);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode($produto->getAll());
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $nome = $data['nome'];
        $tipo_id = $data['tipo_id'];
        $preco = $data['preco'];
        $produto->create($nome, $tipo_id, $preco);
        echo json_encode(['message' => 'Produto criado com sucesso']);
        break;
    // Outros métodos conforme necessário
}
?>
