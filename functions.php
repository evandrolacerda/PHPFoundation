<?php

function verifica_rota($uri)
{

    $rotas = array(
        'home' => VIEWS_PATH . 'home.php',
        '' => VIEWS_PATH . 'home.php',
        '/' => VIEWS_PATH . 'home.php',
        'empresa' => VIEWS_PATH .'empresa.php',
        'contato' => VIEWS_PATH .'contato.php',
        'servicos' => VIEWS_PATH .'servicos.php',
        'produtos' => VIEWS_PATH .'produtos.php',
        'envia_contato' => VIEWS_PATH .'envia_contato.php',
        'busca' => VIEWS_PATH .'busca.php',
        'admin' => VIEWS_PATH .'admin/index.php',
        'admin/servicos' => VIEWS_PATH .'admin/servicos.php',
        'admin/login' => VIEWS_PATH .'admin/login.php',
        'admin/empresa' => VIEWS_PATH .'admin/empresa.php',
        'admin/produtos' => VIEWS_PATH .'admin/produtos.php',
        'admin/apagar_produto' => VIEWS_PATH .'admin/apagar_produto.php',
        'admin/apagar_servico' => VIEWS_PATH .'admin/apagar_servico.php',
    );

    $conOb = new \App\Database\Conexao();
    
    $loginObj = new \App\Util\Login( $conOb->getConnection() );
    
    
    $paginasProtegidas = ['admin', 'admin/servicos', 'admin/empresa', 
        'admin/produtos', 'admin/apagar_produto', 'admin/apagar_servico'];

    $response = null;

    foreach ($rotas as $rota => $arquivo) {
        if ($rota == $uri) {
            if (in_array($rota, $paginasProtegidas) ) {
                if( $loginObj->isLoged() ){
                    $response = $arquivo;
                }else{
                    $response = VIEWS_PATH . 'admin/login.php'; 
                }
            }else{
             $response = $arquivo;   
            }
            
        }
    }

    if (!is_null($response)) {
        include (file_exists($response) ) ? $response : VIEWS_PATH . '404.php';
        //return;
    } else {
        header("HTTP/1.0 404 Not Found");

        include VIEWS_PATH . '404.php';
        exit();
    }
}


function url( $target, $params = null )
{
    $url = 'http://'.$_SERVER['SERVER_NAME'];
    
    if( isset( $_SERVER['SERVER_PORT']) ){
        $url .= ':' .  $_SERVER['SERVER_PORT'];
        
    }
    
    
    $url .= $target;
    
    if( $params ){
        $url .= http_build_query( $params );
    }
    return $url;
    
}