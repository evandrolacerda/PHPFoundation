<?php
require './Conexao.php';

$connOb = new Conexao();
$connection = $connOb->getConnection();

$stmt = $connection->prepare("SELECT * FROM empresa");
$stmt->execute();
$row = $stmt->fetch(\PDO::FETCH_ASSOC);
?>
<ol class="breadcrumb">
    <li><a href="/home">Home</a></li>
    <li><a href="/empresa">Empresa</a></li>
</ol>
<h1><?php echo htmlentities($row['nome'], ENT_QUOTES, 'UTF-8');?></h1>

<p><?php 
echo htmlentities($row['descricao'], ENT_QUOTES, 'UTF-8');
?></p>