<?php
$connOb = new \App\Database\Conexao();
$connection = $connOb->getConnection();

$empresa = $connection->prepare("SELECT * FROM empresa");
$empresa->execute();
$registroEmpresa = $empresa->fetch(\PDO::FETCH_OBJ);


//manipula os dados vindos pelo formulário POST

if (isset($_POST['descricao'])) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao');
    $id = filter_input(INPUT_POST, 'empresa_id', FILTER_VALIDATE_INT);

    if (!$id && !$descricao && !$nome) {
        $_SESSION['erros'][] = "Não foi possível atualizar os dados da Empresa";
        header('Location: ' . url('/admin'));
    }
    try {
        $empresaModel = new \App\Model\Empresa($connection);
        $empresaModel->update($id, ['nome' => $nome, 'descricao' => $descricao]);
        $_SESSION['status'] = "Empresa atualizada!";
        header('Location: ' . url('/admin'));
    } catch (\Exception $ex) {
        $_SESSION['erros'][] = "Não foi possível atualizar os dados da Empresa {$ex->getMessage()}";
    }
}
?>
<hr>
<div class="panel panel-primary">
    <div class="panel-heading">Alterar Dados da Empresa</div>
    <div class="panel-body">
        <form class="form-horizontal" method="post">
            <input type="hidden" name="empresa_id" value="<?php echo htmlentities($registroEmpresa->id, ENT_QUOTES, 'UTF-8'); ?>" >
            <div class="form-group">
                <label for="nome" class="col-sm-1 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nome" id="nome" 
                           value="<?php echo htmlentities($registroEmpresa->nome, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Nome" >
                </div>
            </div>
            <div class="form-group">
                <label for="nome" class="col-sm-1 control-label">Descrição</label>
                <div class="col-sm-10">
                    <textarea name="descricao" class="form-control" rows="10">
                        <?php echo htmlentities($registroEmpresa->descricao, ENT_QUOTES, 'UTF-8'); ?>
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

<script>
    CKEDITOR.replace('descricao');
</script>