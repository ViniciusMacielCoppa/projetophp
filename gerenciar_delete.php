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

        $sql = "DELETE FROM usuarios WHERE user_id = '$id_change'";
        $resultado = mysqli_query($conexao, $sql);
        header("location: painelUsuarios.php");
    }else{
        header("location: painelUsuarios.php");
    }
?>