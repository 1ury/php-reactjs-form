<?php
require_once __DIR__ . '/BaseTest.php';
require_once __DIR__ . '/../models/Venda.php';
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/TipoProduto.php';

use App\Models\Venda;
use App\Models\Produto;
use App\Models\TipoProduto;

class VendaTest extends BaseTest {
     public function testCreate() {
        $tipoProduto = new TipoProduto($this->pdo);
        $tipoProduto->create('Eletrônicos', 15);

        $stmt = $this->pdo->query("SELECT id FROM tipos_produtos WHERE nome = 'Eletrônicos'");
        $tipo = $stmt->fetch(PDO::FETCH_ASSOC);

        $produto = new Produto($this->pdo);
        $produto->create('Notebook', $tipo['id'], 2500);

        $stmt = $this->pdo->query("SELECT id FROM produtos WHERE nome = 'Notebook'");
        $prod = $stmt->fetch(PDO::FETCH_ASSOC);

        $venda = new Venda($this->pdo);
        $itens = [
            ['produto_id' => $prod['id'], 'quantidade' => 2, 'subtotal' => 5000, 'imposto' => 750]
        ];
        $result = $venda->create($itens);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM vendas");
        $vendaData = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotFalse($vendaData);
    }
}
