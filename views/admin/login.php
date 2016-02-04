<style>
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
    }

    .form-signin {
        max-width: 430px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin .checkbox {
        font-weight: normal;
    }
    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<div class="container">
<?php
$connOb = new \App\Database\Conexao();
$connection = $connOb->getConnection();
$loginObject = new \App\Util\Login($connection);

if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha');

    try {
        $loginObject->logar($usuario, $senha, './admin');
    } catch (\Exception $exc) {
        ?>
    <hr>
        <div class="alert alert-danger alert-dismissable">
            Erro: <?php echo $exc->getMessage()?>
        </div>

        <?php
    }
}
if( isset( $_GET['action']) && $_GET['action'] === 'logout'){
    $loginObject->logout( url('/admin/login') );
}

?>

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Faça Login</h2>
        <label for="inputEmail" class="sr-only">Usuário</label>
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuário" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <br>
        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
        <button class="btn btn-primary btn-block" type="submit">Logar</button>
    </form>

</div> <!-- /container -->
