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

        $sql = "UPDATE usuarios SET user_senha = '123456' WHERE user_id = '$id_change'";
        $resultado = mysqli_query($conexao, $sql);
        header("location: painelUsuarios.php");
    }else{
        header("location: painelUsuarios.php");
    }
?>