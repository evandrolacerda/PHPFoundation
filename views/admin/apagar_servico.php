<?php
$connOb = new \App\Database\Conexao();
$connection = $connOb->getConnection();

$servicosModel = new \App\Model\Servico($connection);

if( isset( $_GET['id']) ){
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT );
    
    if( $id ){
        $servicosModel->delete($id);
        $_SESSION['status'] = 'Serviço deletado!'; 
        header('Location: ' . url('/admin/servicos'));
    }else{
        header('Location: ' . url('/admin/servicos'));
    }
}

