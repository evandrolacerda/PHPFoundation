<?php
require './Conexao.php';

$connOb = new Conexao();
$connection = $connOb->getConnection();

echo "--------------------------------------------------------------------------\n";
echo 'Deletando tabela' . PHP_EOL;
$connection->query("DROP TABLE IF EXISTS servicos");
echo ' - OK' . PHP_EOL;
echo "--------------------------------------------------------------------------\n";
echo 'Criando tabela servicos' . PHP_EOL;
$connection->query("CREATE TABLE servicos ( "
        . "id INT NOT NULL AUTO_INCREMENT,"
        . "nome VARCHAR(100) NOT NULL,"
        . "descricao VARCHAR(255) NULL,"
        . "PRIMARY KEY (id)"
        . " );");


$stmt = $connection->prepare("INSERT INTO servicos (nome, descricao ) VALUES( :nome, :descricao )");

echo "--------------------------------------------------------------------------\n";
echo 'Inserindo registro na tabela servicos' . $x . PHP_EOL;

for( $x = 1; $x < 10; $x++ ){
    echo "--------------------------------------------------------------------------\n";
    echo 'Inserindo registro na tabela servicos' . $x . PHP_EOL;
    $nome = "Serviço {$x}";
    $descricao = "Descricao do serviço {$x}";
    $stmt->bindParam( ':nome', $nome );
    $stmt->bindParam( ':descricao', $descricao );
    
    $stmt->execute();
}

echo "--------------------------------------------------------------------------\n";
echo 'Criando tabela produtos' . PHP_EOL;

$connection->query("DROP TABLE IF EXISTS produtos");
$connection->query("CREATE TABLE produtos ("
        . "id INT NOT NULL AUTO_INCREMENT,"
        . "nome VARCHAR(255) NULL,"
        . "PRIMARY KEY(id)"
        . ")");

$stmtProdutos = $connection->prepare("INSERT INTO produtos (nome) VALUES(:nome)");

for( $x = 1; $x < 10; $x++){
    echo "--------------------------------------------------------------------------\n";
    echo 'Inserindo registro na tabela produtos' . $x . PHP_EOL;
    $nome = "Produto {$x}";
    $stmtProdutos->bindParam( ':nome', $nome );
    
    $stmtProdutos->execute();
}

echo ' - OK' . PHP_EOL;

echo "--------------------------------------------------------------------------\n";
echo 'Criando tabela empresa' . PHP_EOL;

$connection->query('DROP TABLE IF EXISTS empresa');

$connection->query("CREATE TABLE empresa ("
        . "id INT NOT NULL AUTO_INCREMENT,"
        . "nome VARCHAR(255) NULL,"
        . "descricao VARCHAR(255) NULL,"
        . "PRIMARY KEY(id)"
        . ")");

echo "--------------------------------------------------------------------------\n";
echo 'Inserindo dados na tabela empresa' . PHP_EOL;

$stmtEmpresa = $connection->prepare("INSERT INTO empresa (nome, descricao) VALUES( :nome, :descricao )");

$stmtEmpresa->bindValue(':nome', 'TABAJARA PRODUTOS E SERVIÇOS');
$stmtEmpresa->bindValue(':descricao', 'Somos uma empresa com mais de 30 anos de mercado, '
        . 'sempre oferecendo os melhores produtos '
        . 'e serviços com mão de obra altamente qualificada, agilidade e bom preço. '
        . 'Confira nossos produtos e serviços. Teremos o maior prazer em atender '
        . 'a sua demanda. Entre em contato!');
$stmtEmpresa->execute();
