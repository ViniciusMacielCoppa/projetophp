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

    $nome = trim($_SESSION['usuario']['nome']);
    $id = trim($_SESSION['usuario']['id']);

    if(empty($nome) || empty($id)){
        header("location: login.php");
        exit();
    }
?>


<?php


        if(!isset($_POST['atualizar'])){
            exit();
        }

        $nome2 = trim($_POST['nome']);
        $id = $_POST['id'];
        $status = $_POST['status'];

        if(!empty($nome)){
            if(isset($_POST['senhapadrao'])){
                echo $name2;
            }


        }







?>