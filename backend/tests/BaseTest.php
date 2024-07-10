<?php
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase {
    protected $pdo;

    protected function setUp(): void {
        $this->pdo = new PDO('pgsql:host=localhost;dbname=banco_de_teste', 'postgres', '12345678');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->createTestTables();
    }

    
    protected function tearDown(): void {
        $this->dropTestTables();
        $this->pdo = null;
    }

    protected function createTestTables() {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS tipos_produtos (
                id SERIAL PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                imposto_percentual DECIMAL(5, 2) NOT NULL
            );

            CREATE TABLE IF NOT EXISTS produtos (
                id SERIAL PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                preco DECIMAL(10, 2) NOT NULL,
                tipo_id INT REFERENCES tipos_produtos(id)
            );

            CREATE TABLE IF NOT EXISTS vendas (
                id SERIAL PRIMARY KEY,
                data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS itens_venda (
                id SERIAL PRIMARY KEY,
                venda_id INT REFERENCES vendas(id) ON DELETE CASCADE,
                produto_id INT REFERENCES produtos(id),
                quantidade INT NOT NULL,
                preco_unitario DECIMAL(10, 2) NOT NULL,
                imposto DECIMAL(10, 2) NOT NULL
            );
        ");
    }

    protected function dropTestTables() {
        $this->pdo->exec("DROP TABLE IF EXISTS itens_venda CASCADE");
        $this->pdo->exec("DROP TABLE IF EXISTS vendas CASCADE");
        $this->pdo->exec("DROP TABLE IF EXISTS produtos CASCADE");
        $this->pdo->exec("DROP TABLE IF EXISTS tipos_produtos CASCADE");
    }
}
