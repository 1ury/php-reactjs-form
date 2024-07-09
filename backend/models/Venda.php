<?php
class Venda {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM vendas');
        return $stmt->fetchAll();
    }

    public function create($itens) {
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare('INSERT INTO vendas (data) VALUES (NOW()) RETURNING id');
            $stmt->execute();
            $venda_id = $stmt->fetchColumn();
            // var_dump($itens);die;
            foreach ($itens as $item) {
                $stmt = $this->pdo->prepare('INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco_unitario, imposto) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$venda_id, $item['produto_id'], $item['quantidade'], $item['subtotal'], $item['imposto']]);
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
?>
