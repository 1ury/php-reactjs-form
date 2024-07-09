<?php

class TipoProduto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM tipos_produtos');
        return $stmt->fetchAll();
    }

    public function create($nome, $imposto_percentual) {
        $stmt = $this->pdo->prepare('INSERT INTO tipos_produtos (nome, imposto_percentual) VALUES (:nome, :imposto)');
        return $stmt->execute(['nome' => $nome, 'imposto' => $imposto_percentual]);
    }
}
