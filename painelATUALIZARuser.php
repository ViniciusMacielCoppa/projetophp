<?php 
    session_start();

    if(!$_SESSION['usuario']['permissoes']['criar usuario']){
        header('location: painelUsuarios.php');
        exit();
    }
    
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
?>


<?php


        if(!isset($_POST['atualizar'])){
            exit();
        }

        $nome = trim($_POST['nome']);
        $id = $_POST['id'];
        $status = $_POST['status'];

        if(!empty($nome)){
            if(isset($_POST['senhapadrao'])){
                }
                
                echo $nome;
                echo $status;
        }







?>