<?php
require_once __DIR__ . '/../Conexao.php';

$connOb = new Conexao();
$connection = $connOb->getConnection();

//sanitiza a string de busca
$searchTerm = filter_input( INPUT_POST, 'busca', FILTER_SANITIZE_STRING );


//busca em produtos
$stmtProdutos = $connection->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
$stmtProdutos->bindValue( 1, "%{$searchTerm}%" );
$stmtProdutos->execute();

//busca em serviços
$stmtServicos = $connection->prepare("SELECT * FROM servicos WHERE nome LIKE ?");
$stmtServicos->bindValue( 1, "%{$searchTerm}%" );
$stmtServicos->execute();

?>
<ol class="breadcrumb">
    <li><a href="/home">Home</a></li>
    <li><a href="/contato">Contato</a></li>
</ol>
<?php 
if (isset($_SESSION['erros'])) {
    echo '<div class="alert alert-danger">';
    echo '<ul>';
    
    foreach ($_SESSION['erros'] as $erro) {
        ?>
        <li><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php
        
        
    }
    echo '</ul>';
    echo '</div>';
    
    unset( $_SESSION['erros']);
}

?>
        <div class="panel">
            <div class="panel-heading">Resultado da Busca</div>
            <div class="panel-body">
                <h3>Em Produtos</h3>
                <hr>
                <table class="table table-striped">
                    <?php 
                    if( $stmtProdutos->rowCount() > 0 ){
                        while( $rowProdutos = $stmtProdutos->fetch( \PDO::FETCH_OBJ ))
                        {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($rowProdutos->id, ENT_QUOTES, 'UTF-8');?></td>
                                    <td>
                                        <a href="/produtos">
                                        <?php echo htmlentities($rowProdutos->nome, ENT_QUOTES, 'UTF-8');?>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }else{
                        echo 'Nenhum registro em Produtos';
                    }
                        
                    
                    ?>
                </table>
                
                <h3>Em Servi&ccedil;os</h3>
                <hr>
                <table class="table table-striped">
                    <?php 
                    if( $stmtServicos->rowCount() > 0 ){
                        while( $rowServicos = $stmtServicos->fetch( \PDO::FETCH_OBJ ))
                        {
                            ?>
                                
                                <tr>
                                    <td>
                                        
                                            <?php echo htmlentities($rowServicos->id, ENT_QUOTES, 'UTF-8');?>
                    
                                        </td>
                                    <td>
                                        <a href="/servicos">
                                            <?php echo htmlentities($rowServicos->nome, ENT_QUOTES, 'UTF-8');?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo htmlentities($rowServicos->descricao, ENT_QUOTES, 'UTF-8');?>
                                    </td>
                                </tr>
                                
                            <?php
                        }
                    }else{
                        echo 'Nenhum registro em Serviços';
                    }
                    ?>
                </table>
            </div>
        </div>