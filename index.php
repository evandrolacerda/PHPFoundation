<?php 
    require_once './bootstrap.php';
    
?>
<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Curso PHP Foundation</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.css" rel="stylesheet">



        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">
            <?php
            require_once './templates/menu_topo.php';
            ?>

            <div id="content">
                <?php
                if (isset($_GET['page'])) {
                    switch ($_GET['page']) {
                        case 'contato':
                            require_once './contato.php';
                            break;
                        case 'produtos':
                            require_once './produtos.php';
                            break;
                        case 'empresa':
                            require_once './empresa.php';
                            break;
                        case 'home':
                            require_once './home.php';
                            break;
                        case 'servicos':
                            require_once './servicos.php';
                            break;
                        default :
                        case 'envia_contato':
                            require_once './envia_contato.php';
                            break;
                        default :
                            echo '<h1>Página não encontrada</h1>';
                    }
                } else {
                    require_once './home.php';
                }
                ?>                
            </div>


<?php
require_once './templates/rodape.php';
?>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
