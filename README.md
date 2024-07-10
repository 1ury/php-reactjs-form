# Projeto de Mercado - Sistema de Vendas

Este é um projeto de sistema de mercado desenvolvido utilizando PHP no backend e React no frontend.

## Instruções para Rodar o Projeto

### Backend (PHP)

1. **Configuração do Banco de Dados**
   - Certifique-se de ter o PostgreSQL instalado e configurado no seu ambiente.
   - Crie um banco de dados no PostgreSQL para o projeto.
   - o backup do banco que foi utilizado para fins de teste de funcionalidade se encontra na raiz do projeto com o nome `backup.bak`
   - Não esqueça de dar um start no postgre com o comando `sudo service postgresql start` (caso estiver no terminal WSL ou em um Linux)

2. **Configuração do Banco de Dados no Backend**
   - No arquivo `backend/config/database.php`, ajuste as configurações de conexão com o banco de dados:
     ```php
     <?php
     $host = 'localhost';
     $dbname = 'nome_do_seu_banco_de_dados';
     $username = 'seu_usuario';
     $password = 'sua_senha';
     
     $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     ```
     Substitua `nome_do_seu_banco_de_dados`, `seu_usuario` e `sua_senha` pelas suas configurações reais.

3. **Inicialização do Servidor PHP**
   - Abra um terminal na pasta `backend/`.
   - Execute o comando:
     ```
     php -S localhost:8080 -t public
     ```
     Isso iniciará o servidor PHP embutido, acessível em `http://localhost:8080`.

### Frontend (React)

1. **Instalação das Dependências**
   - Certifique-se de ter o Node.js e o npm instalados no seu ambiente.

2. **Configuração do Frontend**
   - No arquivo `frontend/src/index.js`, ajuste a baseURL para o backend PHP na linha 8:
     ```javascript
     axios.defaults.baseURL = 'http://localhost:8080';
     ```

3. **Inicialização do Servidor de Desenvolvimento**
   - Abra um terminal na pasta `frontend/`.
   - Execute o comando:
     ```
     npm install
     npm start
     ```
     Isso iniciará o servidor de desenvolvimento do React e abrirá automaticamente o projeto no seu navegador em `http://localhost:3000`.

## Endpoints do Frontend

Os seguintes endpoints estão disponíveis para o frontend acessar:

- **Cadastro de Produtos:** `/cadastro-produtos`
- **Cadastro de Tipos de Produto:** `/cadatro-tipo`
- **Realizar Venda:** `/venda`

## Endpoints do Backend

Os seguintes endpoints para o backend acessar:

- **Produtos:** `/api/produtos`
- **Tipos de Produto:** `/api/tipo`
- **Venda:** `/api/venda`

## Testes Unitários
## Configuração dos Testes
   - No arquivo `backend/tests/BaseTest.php`, ajuste as configurações de conexão com o banco de dados:
     ```php
     <?php
     class BaseTest extends TestCase {
        protected $pdo;

        protected function setUp(): void {
            $this->pdo = new PDO('pgsql:host=localhost;dbname=seu_banco_de_teste', 'seu_usuario_de_teste', 'sua_senha_de_teste');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTestTables();
        }
     ```
     Substitua `seu_banco_de_teste`, `seu_usuario_de_teste` e `sua_senha_de_teste` pelas suas configurações reais.
   - Para rodar os testes unitários, com o terminal navegue até o diretório backend e execute:
     ```
     vendor/bin/phpunit
     ```

## Estrutura dos Testes
1. **Os testes estão localizados no diretório backend/tests e incluem:**
- **BaseTest.php** `Configuração base para os testes, incluindo a criação e destruição das tabelas de testes`
- **TipoProdutoTest.php** `Testes para o model "TipoProduto"`
- **ProdutoTest.php** `Testes para o model "Produto"`
- **VendaTest.php** `Testes para o model "Venda"`
- **ItemVendaTest.php** `Testes para o model "ItemVenda"`

## Considerações Finais

Certifique-se de ter todas as dependências instaladas corretamente antes de iniciar o projeto. Para mais detalhes sobre as funcionalidades específicas do projeto, consulte a documentação do código fonte.

Esse README fornece uma base sólida para ajudar outros desenvolvedores a configurar e executar o projeto em seus próprios ambientes. Personalize as instruções conforme necessário para refletir as particularidades do seu ambiente de desenvolvimento.
