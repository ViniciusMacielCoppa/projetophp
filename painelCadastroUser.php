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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastrar_user.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <main>
        <div>
            <h1>Cadastro de usuários</h1>
            <a href="painelUsuarios.php">Voltar</a>
        </div>

        <form action="painelCadastroUser.php" method="POST">
            <input type="text" name="nome" placeholder="User Name">
            <input type="hidden" name="senhapadrao" value="123456">
            <select name="status" id="">
                <option value="Ceo">CEO</option>
                <option value="Jornalista">JORNALISTA</option>
                <option value="Staff" select>STAFF</option>
            </select>
            <button type="submit" name="send">Cadastrar</button>
        </form>
    </main>
</body>
</html>

<?php 
    if(isset($_POST['send'])){
        $nome = trim($_POST['nome']);
        $status = $_POST['status'];

        if(!empty($nome)){
            $sql = "INSERT INTO usuarios (user_name, user_senha, user_status) VALUES ('$nome', '123456', '$status')";
            $resultado = mysqli_query($conexao, $sql);
            mysqli_close($conexao);
            echo "<p class='sucesso'>Usuario cadastrado</p>";
        }else{
            echo "<p class='erro'>Digite Algo</p>";
        }
    }
?>
