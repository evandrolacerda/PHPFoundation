<?php
require_once './Conexao.php';

//Conexão com o banco de dados
$connOb = new Conexao();
$connection = $connOb->getConnection();
?>
<ol class="breadcrumb">
    <li><a href="/home">Home</a></li>
    <li><a href="/servicos">Servi&ccedil;os</a></li>
</ol>

<h1>Serviços</h1>
<?php
$stmt = $connection->prepare("SELECT * FROM servicos");
$stmt->execute();
?>
<ul>
    <?php
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        ?>
        <li><?php
    echo htmlentities($row['nome'], ENT_QUOTES, 'UTF-8');
    echo ' - ';
    echo htmlentities($row['descricao'], ENT_QUOTES, 'UTF-8');
        ?></li>
            <?php
    }
    ?>
</ul>