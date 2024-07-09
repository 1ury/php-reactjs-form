<?php
require '../config/database.php';
require '../models/Venda.php';

$venda = new Venda($pdo);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode($venda->getAll());
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $itens = $data['itens'];
        $venda->create($itens);
        echo json_encode(['message' => 'Venda realizada com sucesso']);
        break;
}
?>
