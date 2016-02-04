<?php
//Conexão com o banco de dados
$connOb = new \App\Database\Conexao();
$connection = $connOb->getConnection();
?>
<ol class="breadcrumb">
    <li><a href="/home">Home</a></li>
    <li><a href="/produtos">Produtos</a></li>
</ol>
<h1>Produtos</h1>
<?php
$stmt = $connection->prepare("SELECT * FROM produtos");
$stmt->execute();

while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
    ?>
        <div class="panel panel-info">
            <div class="panel-heading"><?php echo htmlentities($row['nome'], ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="panel-body">
                  <?php 
                    echo $row['descricao'];
                ?>
            </div>
        </div>
        
    <?php
}
?>