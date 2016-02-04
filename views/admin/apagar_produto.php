<?php
$connOb = new \App\Database\Conexao();
$connection = $connOb->getConnection();

$produtosModel = new \App\Model\Produto($connection);

if( isset( $_GET['id']) ){
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT );
    
    if( $id ){
        $produtosModel->delete($id);
        $_SESSION['status'] = 'Produto deletado!'; 
        header('Location: ' . url('/admin/produtos'));
    }else{
        header('Location: ' . url('/admin/produtos'));
    }
}

