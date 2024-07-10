<?php
namespace App\Models;

class Produto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM produtos');
        return $stmt->fetchAll();
    }

    public function create($nome, $tipo_id, $preco) {
        $stmt = $this->pdo->prepare('INSERT INTO produtos (nome, tipo_id, preco) VALUES (?, ?, ?)');
        return $stmt->execute([$nome, $tipo_id, $preco]);
    }

    // Outros métodos conforme necessário
}
?>
