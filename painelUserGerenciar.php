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


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.css" integrity="sha512-x9WwyMYBnlXMNQ6kQ/Lyzu1NqIhLQKL5Oq6xByfXuRj7s9CskyCbLv/1IjqzJmXwFXWr0ov6jBV7Qbc0hh9nHg==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <link rel="stylesheet" href="css/gerenciar_user.css">
    <title>GERENCIAMENTO</title>
</head>
<body>

    <main>
        <div>
            <h1>Gerenciador de usuários</h1>
            <a href="painelUsuarios.php">Voltar</a>
        </div>

        <?php 
            $id = $_POST['id_user'];

            $sql = "SELECT * FROM usuarios WHERE user_id = '$id'";

            $resultado = mysqli_query($conexao, $sql);
            $amz = mysqli_fetch_array($resultado);


            // SERÁ NECESSARIO CRIAR A OPÇÃO DE EXCLUIR O USUARIO
            // TIRAR OS BAGULHO DO ECHO DPS E POR OS CODIGOS SEPARADOS


            echo"<form action='painelATUALIZARuser.php' method='POST'>";
            echo"<input type='text' name='nome' placeholder='Nome do usuario: ".$amz['user_name']."' value='".$amz['user_name']."'>";
            echo"<select name='status'>";
            if($amz['user_status'] == "Ceo"){
                echo"<option value='Ceo' selected>CEO</option>";
                echo"<option value='Jornalista'>Jornalista</option>";
                echo"<option value='Staff'>Staff</option>";
            }elseif($amz['user_status'] == "Jornalista"){
                echo"<option value='Ceo' >Ceo</option>";
                echo"<option value='Jornalista' selected>Jornalista</option>";
                echo"<option value='Staff' >Staff</option>";
            }
            elseif($amz['user_status'] == "Staff"){
                echo"<option value='Ceo'>Ceo</option>";
                echo"<option value='Jornalista'>Jornalista</option>";
                echo"<option value='Staff' selected>Staff</option>";
            }
            echo"</select>";
            echo"<label>";
            echo"<p>Por senha padrão?</p>";
            echo"<p>'123456'</p>";
            echo"<input type='checkbox' name='senhapadrao' value='123456'>";
            echo"</label>";
            echo"<button type='submit' name='atualizar' id='bntatualizar'>Salvar alterações</button>";
            echo"<button type='submit' name='deletuser' id='bntdeletarconta'>Deletar conta</button>";
            echo"<input type='hidden' name='id' value='".$amz['user_id']."'>";
            echo"</form>";
        ?>   
    </main>
    
</body>
</html>