<ol class="breadcrumb">
    <li><a href="index.php?page=home">Home</a></li>
    <li><a href="index.php?page=contato">Contato</a></li>
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
<div class="well">
    <form class="form-horizontal" method="post" action="index.php?page=envia_contato">
        <fieldset>
            <legend>Entre em Contato</legend>
            <div class="form-group">	
                <label for="nome" class="col-lg-3 control-label">Nome</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control input-sm" name="nome" placeholder="Nome Completo"
                           value="<?php echo (isset($_SESSION['dados']['nome'])) ? $_SESSION['dados']['nome'] : '';?>">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-3 control-label">Email</label>
                <div class="col-lg-4">
                    <input type="email" class="form-control input-sm" name="email" placeholder="E-mail"
                           value="<?php echo (isset($_SESSION['dados']['nome'])) ? $_SESSION['dados']['email'] : '';?>">        
                </div>
            </div>						
            <div class="form-group">
                <label for="Assunto" class="col-lg-3 control-label">Assunto</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control input-sm" name="assunto" placeholder="assunto"
                           value="<?php echo (isset($_SESSION['dados']['nome'])) ? $_SESSION['dados']['assunto'] : ''; ?>">        
                </div>
            </div>						
            <div class="form-group">
                <label for="Mensagem" class="col-lg-3 control-label">Mensagem</label>
                <div class="col-lg-4">
                    <textarea name="mensagem" class="form-control"><?php 
                            echo (isset($_SESSION['dados']['mensagem'])) ? $_SESSION['dados']['mensagem'] : '';
                        ?></textarea>
                </div>
            </div>						

            <div class="form-group">
                <div class="col-lg-8 col-lg-offset-3">
                    <button type="reset" class="btn btn-default">Cancelar</button>
                    <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
