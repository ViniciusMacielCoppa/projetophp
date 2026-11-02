<?php 
    require 'conexao.php';

    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="painel.php" method="POST">
        <input type="text" name="name" placeholder="user name">
        <input type="text" name="password" placeholder="user password">
        <select name="stats">
            <option value="1">CEO</option>
            <option value="2">JORNALISTA</option>
            <option value="3" selected>STAFF</option>
        </select>
        <button type="submit" name="send">Cadastrar</button>
    </form>
</body>
</html>



<!-- apagar dps -->
<?php 
    if(isset($_POST['send'])){

            $nome = trim($_POST['name']);
            $senha = trim($_POST['password']);

            if(!(empty($nome) || empty($senha))){
                $name = $_POST['name'];
                $password = $_POST['password'];
                $stats = $_POST['stats'];
            
                $sql = "INSERT INTO usuarios (user_name, user_status, user_senha) VALUES ('$name','$stats','$password')";
                $resultado = mysqli_query($conexao, $sql);
                mysqli_close($conexao);
            }else{
                echo "tente novamente";
            }
        }
?>