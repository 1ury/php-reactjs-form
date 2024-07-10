<?php

require '../config/database.php';
require '../models/TipoProduto.php';

$tipoProduto = new App\Models\TipoProduto($pdo);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode($tipoProduto->getAll());
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $nome = $data['nome'];
        $imposto_percentual = $data['imposto'];
        if ($tipoProduto->create($nome, $imposto_percentual)) {
            echo json_encode(['message' => 'Tipo de produto criado com sucesso']);
        } else {
            echo json_encode(['message' => 'Erro ao criar tipo de produto'], 500);
        }
        break;
}
?>
