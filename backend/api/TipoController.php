<?php
require '../config/database.php';
require '../models/TipoProduto.php';

$tipoProduto = new TipoProduto($pdo);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode($tipoProduto->getAll());
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $nome = $data['nome'];
        $imposto_percentual = $data['imposto_percentual'];
        $tipoProduto->create($nome, $imposto_percentual);
        echo json_encode(['message' => 'Tipo de produto criado com sucesso']);
        break;
}
?>
