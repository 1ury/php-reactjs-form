<?php
require_once __DIR__ . '/BaseTest.php';
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/TipoProduto.php';

use App\Models\Produto;
use App\Models\TipoProduto;

class ProdutoTest extends BaseTest {
    public function testCreate() {
        $tipoProduto = new TipoProduto($this->pdo);
        $tipoProduto->create('Eletrônicos', 15);

        $stmt = $this->pdo->query("SELECT id FROM tipos_produtos WHERE nome = 'Eletrônicos'");
        $tipo = $stmt->fetch(PDO::FETCH_ASSOC);
        $produto = new Produto($this->pdo);
        $result = $produto->create('Notebook', $tipo['id'], 2500);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM produtos WHERE nome = 'Notebook'");
        $prod = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotFalse($prod);
        $this->assertEquals('Notebook', $prod['nome']);
        $this->assertEquals(2500, $prod['preco']);
        $this->assertEquals($tipo['id'], $prod['tipo_id']);
    }
}
