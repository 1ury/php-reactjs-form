<?php
namespace App\Models;
require_once __DIR__ .'/../models/ItemVenda.php';
use App\Models\ItemVenda;

class Venda {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($itens) {
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare('INSERT INTO vendas DEFAULT VALUES RETURNING id');
            $stmt->execute();
            $vendaId = $stmt->fetchColumn();

            $itemVenda = new ItemVenda($this->pdo);
            foreach ($itens as $item) {
                $itemVenda->create($vendaId, $item['produto_id'], $item['quantidade'], $item['subtotal'], $item['imposto']);
            }

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM vendas');
        return $stmt->fetchAll();
    }
}
?>
