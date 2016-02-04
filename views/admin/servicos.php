<?php
$connOb = new \App\Database\Conexao();
$connection = $connOb->getConnection();

$servicosModel = new \App\Model\Servico($connection);

if (isset($_GET['id'])) {
    $servico = $servicosModel->find(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
}

if (isset($_POST['nome'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao' );

    if (!$nome) {

        $_SESSION['erros'][] = "O campo nome é obrigatório!";

        unset($_POST);

        header('Location: ' . url('/admin/servicos'));
        exit();
    }//if (!$nome)
    if (!$id && $nome !== false) {
        try {
            $servicosModel->insert(['nome'], ['nome' => mb_strtoupper($nome), 'descricao' => $descricao ]);
            $_SESSION['status'] = 'Serviço inserido!';
            header('Location: ' . url('/admin/servicos'));
        } catch (\Exception $exc) {
            $_SESSION['erros'][] = "Erro ao inserir Serviço! \n {$exc->getMessage() }";
        }
    }//if (!$id)
    if ($id && $nome) {
        try {
            $servicosModel->update($id, ['nome' => mb_strtoupper($nome), 'descricao' => $descricao]);
            $_SESSION['status'] = 'Serviço atualizado!';
            header('Location: ' . url('/admin/servicos'));
        } catch (\Exception $exc) {
            $_SESSION['erros'][] = "Erro ao atualizar serviço! \n {$exc->getMessage() }";
        }
    } //fim if($id && $nome)
}
?>

<hr>
<div class="panel panel-primary">
    <div class="panel-heading">Serviço</div>
    <div class="panel-body">
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label for="id" class="col-sm-1 control-label">Código</label>
                <div class="col-sm-10">
                    <p class="form-control-static">
                        <?php
                        if (isset($servico)):
                            echo $servico->id;
                        endif;
                        ?>
                    </p>
                    <input type="hidden" class="form-control" name="id" id="id" 
                           value="<?php
                           if (isset($servico)):
                               echo $servico->id;
                           endif;
                           ?>" placeholder="ID" readonly>
                </div>
            </div>        
            <div class="form-group">
                <label for="nome" class="col-sm-1 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nome" id="nome" 
                           value="<?php
                           if (isset($servico)) :
                               echo $servico->nome;
                           endif;
                           ?>" placeholder="Nome">
                </div>
            </div>        
            <div class="form-group">
                <label for="nome" class="col-sm-1 control-label">Descrição</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="descricao" id="descricao">
                           <?php
                           if (isset($servico)) :
                               echo $servico->descricao;
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
    foreach ($servicosModel->findAll() as $servico) {
        ?>
        <tr>
            <td><?php echo $servico->id; ?></td>
            <td><?php echo $servico->nome; ?></td>
            <td><a href="<?php echo url('/admin/servicos?', array('id' => $servico->id));
        ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a href="<?php echo url('/admin/apagar_servico?', array('id' => $servico->id));
        ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
        <?php
    }
    ?>
</table>

<hr>
<script>
    CKEDITOR.replace('descricao');
</script>