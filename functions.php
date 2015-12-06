<?php

function verifica_rota($uri)
{
        
    $rotas = array(
        'home'          => 'home.php', 
        ''              => 'home.php', 
        '/'             => 'home.php', 
        'empresa'       => 'empresa.php',
        'contato'       => 'contato.php', 
        'servicos'      => 'servicos.php',
        'produtos'      => 'produtos.php', 
        'envia_contato' => 'envia_contato.php'
        );

    $response = null;
    
    foreach ( $rotas as $rota => $arquivo ) {
           if( $rota == $uri ){
             
               $response = VIEWS_PATH . $arquivo;
                
        }
    }
    
    if( !is_null( $response ) ){
        include (file_exists($response) ) ? $response : VIEWS_PATH . '404.php';
        //return;
    }else{
        header("HTTP/1.0 404 Not Found");
        
        include VIEWS_PATH . '404.php';
        exit();
    }
}
