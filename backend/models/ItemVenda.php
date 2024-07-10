<?php
namespace App\Models;

class ItemVenda {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($vendaId, $produtoId, $quantidade, $subtotal, $imposto) {
        $stmt = $this->pdo->prepare('INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco_unitario, imposto) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$vendaId, $produtoId, $quantidade, $subtotal, $imposto]);
    }

    public function getByVendaId($vendaId) {
        $stmt = $this->pdo->prepare('SELECT * FROM itens_venda WHERE venda_id = ?');
        $stmt->execute([$vendaId]);
        return $stmt->fetchAll();
    }
}
?>
