<?php 
    include_once 'conexao.php';

    if(isset($_POST['send'])){

        $nome = trim($_POST['name']);
        $senha = trim($_POST['password']);

        if(!(empty($nome) || empty($senha))){
            $name = $_POST['name'];
            $password = $_POST['password'];
            $stats = $_POST['stats'];
        
            $sql = "INSERT INTO usuarios (user_name, user_status, user_senha) VALUES ('$name','$stats','$password')";
            $resultado = mysqli_query($conexao, $sql);
            header("location: painel.php");
            mysqli_close($conexao);
        }else{
            echo "n deu";
            echo "<a href='painel.php'>voltar</a>";
        }
    }

?>