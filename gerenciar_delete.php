<?php 
    session_start();
    
    if(!$_SESSION['usuario']['autenticado']){
        header("location: login.php");
        exit();
    }
    require 'conexao.php';

    $nomeLogado = trim($_SESSION['usuario']['nome']);
    $idLogado = trim($_SESSION['usuario']['id']);

    if(empty($nomeLogado) || empty($idLogado)){
        header("location: login.php");
        exit();
    }

    if(isset($_POST['delet_user'])){
        $id_change = $_POST['id_user'];

        $sql = "UPDATE usuarios SET user_ativo = FALSE WHERE user_id = ?";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_change);
        mysqli_stmt_execute($stmt);

        header("location: painelUsuarios.php");
    }else{
        header("location: painelUsuarios.php");
    }
?>