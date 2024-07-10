<?php
// Carregar o autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

// Incluir a configuração do banco de dados
require __DIR__ . '/../config/database.php';

// Incluir os modelos que serão testados
require __DIR__ . '/../models/TipoProduto.php';
// require __DIR__ . '/../models/Produto.php';
// require __DIR__ . '/../models/Venda.php';
// require __DIR__ . '/../models/ItemVenda.php';

// Configuração adicional (opcional)
date_default_timezone_set('UTC');

// Outras configurações ou inicializações que você precisar
