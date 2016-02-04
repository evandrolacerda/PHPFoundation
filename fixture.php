<?php
require './App/Database/Conexao.php';

$connOb = new \App\Database\Conexao();
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
        . "descricao text NULL,"
        . "PRIMARY KEY (id)"
        . " );");


$stmt = $connection->prepare("INSERT INTO servicos (nome, descricao ) VALUES( :nome, :descricao )");

echo "--------------------------------------------------------------------------\n";
echo 'Inserindo registro na tabela servicos' . $x . PHP_EOL;

for( $x = 1; $x < 10; $x++ ){
    echo "--------------------------------------------------------------------------\n";
    echo 'Inserindo registro na tabela servicos' . $x . PHP_EOL;
    $nome = "Serviço {$x}";
    $registroEmpresa = "Descricao do serviço {$x}";
    $stmt->bindParam( ':nome', $nome );
    $stmt->bindParam( ':descricao', $registroEmpresa );
    
    $stmt->execute();
}

echo "--------------------------------------------------------------------------\n";
echo 'Criando tabela produtos' . PHP_EOL;

$connection->query("DROP TABLE IF EXISTS produtos");
$connection->query("CREATE TABLE produtos ("
        . "id INT NOT NULL AUTO_INCREMENT,"
        . "nome VARCHAR(255) NULL,"
        . "descricao text NULL,"
        . "PRIMARY KEY(id)"
        . ")");

$stmtProdutos = $connection->prepare("INSERT INTO produtos (nome, descricao) VALUES(:nome, :descricao)");

for( $x = 1; $x < 10; $x++){
    echo "--------------------------------------------------------------------------\n";
    echo 'Inserindo registro na tabela produtos' . $x . PHP_EOL;
    $nome = "Produto {$x}";
    $descricao = "Descricao do Produto {$x}";
    $stmtProdutos->bindParam( ':nome', $nome );
    $stmtProdutos->bindParam( ':descricao', $descricao );
    
    $stmtProdutos->execute();
}

echo ' - OK' . PHP_EOL;

echo "--------------------------------------------------------------------------\n";
echo 'Criando tabela empresa' . PHP_EOL;

$connection->query('DROP TABLE IF EXISTS empresa');

$connection->query("CREATE TABLE empresa ("
        . "id INT NOT NULL AUTO_INCREMENT,"
        . "nome VARCHAR(255) NULL,"
        . "descricao text NULL,"
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


echo "--------------------------------------------------------------------------\n";
echo 'Criando tabela usuarios' . PHP_EOL;

$connection->query('DROP TABLE IF EXISTS usuarios');

$connection->query("CREATE TABLE usuarios ("
        . "id INT NOT NULL AUTO_INCREMENT,"
        . "nome VARCHAR(100) NULL,"
        . "username VARCHAR(50) unique,"
        . "senha VARCHAR(255) NULL,"
        . "PRIMARY KEY(id)"
        . ")");

echo "--------------------------------------------------------------------------\n";



echo "--------------------------------------------------------------------------\n";
echo 'Inserindo dados na tabela usuarios' . PHP_EOL;

$statementUsuario = $connection->prepare("INSERT INTO usuarios (nome, username, senha) "
        . "VALUES(:nome,:username,:senha)");

$statementUsuario->bindValue(':nome', 'Adminsitrador', \PDO::PARAM_STR );
$statementUsuario->bindValue(':username', 'admin', \PDO::PARAM_STR );
$statementUsuario->bindValue(':senha', password_hash('admin', PASSWORD_DEFAULT) , \PDO::PARAM_STR );
$statementUsuario->execute();