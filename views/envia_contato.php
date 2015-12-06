<?php
if (isset($_POST)) {
    $nome       = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email      = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $assunto    = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
    $mensagem   = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

    $erros = array();
    if (!$nome) {
        $erros[] = 'Campo nome não preenchido ou com caracteres inválidos';
    }
    if (!$email) {
        $erros[] = 'Email inválido';
    }
    if (!$assunto) {
        $erros[] = 'Assunto inválido';
    }

    if (!$mensagem) {
        $erros[] = 'Mensagem inválida';
    }

    if (count($erros) == 0) {
        ?>
        <hr>
        <div class="panel panel-success">
            <div class="panel-heading">Dados enviados com sucesso, abaixo seguem os dados que você enviou</div>
            <div class="panel-body">
                <form class="form-horizontal" method="get">
                    <div class="form-group">
                        <label for="nome" class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">
                                <?php 
                                    echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">
                                <?php 
                                    echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome" class="col-sm-2 control-label">Assunto</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">
                                <?php 
                                    echo htmlspecialchars($assunto, ENT_QUOTES, 'UTF-8');
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome" class="col-sm-2 control-label">Assunto</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">
                                <?php 
                                    echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8');
                                ?>
                            </p>
                        </div>
                    </div>
                </form>        
            </div>
        </div>

        <?php
        
        //LIMPA OS DADOS DA SESSION
        unset( $_SESSION['dados']);
    }else{
        //coloca os erros e os dados preenchidos na na session 
        $_SESSION['erros'] = $erros;
        $_SESSION['dados'] = $_POST;
        header('Location: /contato');
    }
}
