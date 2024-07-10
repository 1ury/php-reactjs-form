<?php
require_once __DIR__ . '/BaseTest.php';
require_once __DIR__ . '/../models/TipoProduto.php';

use App\Models\TipoProduto;

class TipoProdutoTest extends BaseTest {
    public function testCreate() {
        $tipoProduto = new TipoProduto($this->pdo);
        $result = $tipoProduto->create('Eletrônicos', 15);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM tipos_produtos WHERE nome = 'Eletrônicos'");
        $tipo = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotFalse($tipo);
        $this->assertEquals('Eletrônicos', $tipo['nome']);
        $this->assertEquals(15, $tipo['imposto_percentual']);
    }
}
