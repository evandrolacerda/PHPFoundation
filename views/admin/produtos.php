<?php
$connOb = new \App\Database\Conexao();
$connection = $connOb->getConnection();

$produtosModel = new \App\Model\Produto($connection);

if (isset($_GET['id'])) {
    $produto = $produtosModel->find(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
}

if (isset($_POST['nome'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao');

    if (!$nome) {
        $_SESSION['erros'][] = "O campo nome é obrigatório!";
        unset($_POST);
        header('Location: ' . url('/admin/produtos'));
        exit();
    }//if (!$nome)
    if (!$id && $nome !== false) {
        try {
            $produtosModel->insert(['nome'], ['nome' => mb_strtoupper($nome), 'descricao' => $descricao ]);
            $_SESSION['status'] = 'Produto inserido!';
            header('Location: ' . url('/admin/produtos'));
        } catch (\Exception $exc) {
            $_SESSION['erros'][] = "Erro ao inserir produto! \n {$exc->getMessage() }";
        }
    }//if (!$id)
    if ($id && $nome) {
        try {
            $produtosModel->update($id, ['nome' => mb_strtoupper($nome),
                'descricao' => $descricao] );
            $_SESSION['status'] = 'Produto atualizado!';
            header('Location: ' . url('/admin/produtos'));
        } catch (\Exception $exc) {
            $_SESSION['erros'][] = "Erro ao atualizar produto! \n {$exc->getMessage() }";
        }
    } //fim if($id && $nome)
}
?>

<hr>
<div class="panel panel-primary">
    <div class="panel-heading">Cadastrar novo Produto</div>
    <div class="panel-body">
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label for="id" class="col-sm-1 control-label">Código</label>
                <div class="col-sm-10">
                    <p class="form-control-static">
                        <?php
                        if (isset($produto)):
                            echo $produto->id;
                        endif;
                        ?>
                    </p>
                    <input type="hidden" class="form-control" name="id" id="id" 
                           value="<?php
                           if (isset($produto)):
                               echo $produto->id;
                           endif;
                           ?>" placeholder="ID" readonly>
                </div>
            </div>        
            <div class="form-group">
                <label for="nome" class="col-sm-1 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nome" id="nome" 
                           value="<?php
                           if (isset($produto)) :
                               echo $produto->nome;
                           endif;
                           ?>" placeholder="Nome">
                </div>
            </div>    
            <div class="form-group">
                <label for="nome" class="col-sm-1 control-label">Descrição</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="descricao" id="descricao">
                           <?php
                           if (isset($produto)) :
                               echo $produto->descricao;
                           endif;
                           ?>
                    </textarea> 
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </form>        
    </div>    
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
    </thead>
    <?php
    foreach ($produtosModel->findAll() as $produto) {
        ?>
        <tr>
            <td><?php echo $produto->id; ?></td>
            <td><?php echo $produto->nome; ?></td>
            <td><a href="<?php echo url('/admin/produtos?', array('id' => $produto->id));
        ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a href="<?php echo url('/admin/apagar_produto?', array('id' => $produto->id));
        ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
        <?php
    }
    ?>
</table>
<script>
    CKEDITOR.replace('descricao');
</script>