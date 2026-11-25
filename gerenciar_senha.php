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

    if(isset($_POST['change_password'])){
        $id_change = $_POST['id_user'];
        $senha = '123456';
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        $sql = "UPDATE usuarios SET user_senha = ? WHERE user_id = ?";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "si", $senha_hash, $id_change);
        mysqli_stmt_execute($stmt);

        header("location: painelUsuarios.php");
    }else{
        header("location: painelUsuarios.php");
    }
?>