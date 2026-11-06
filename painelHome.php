<?php 
    session_start();
    
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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/painel_padrao.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.css" integrity="sha512-x9WwyMYBnlXMNQ6kQ/Lyzu1NqIhLQKL5Oq6xByfXuRj7s9CskyCbLv/1IjqzJmXwFXWr0ov6jBV7Qbc0hh9nHg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>HOME</title>
</head>
<body>
    <header>
        <h1>Painel HK</h1>
        <div id="divheader">
            <!-- <img src="" alt="foto"> -->
            <p><?php echo $_SESSION['usuario']['nome']; ?></p>
            <a href="deslogar.php">sair</a>
        </div>
    </header>

    <main>
        <nav>
            <ul>
                <li><a href=""><i class="fa-solid fa-house"></i>Home</a></li>
                <li><a href=""><i class="fa-solid fa-users"></i>Usuários</a></li>
                <li><a href=""><i class="fa-solid fa-newspaper"></i>Notícias</a></li>
            </ul>
            <p>© Copyright vini259.</p>
        </nav>

        <div id="divmain">
            <div id="container">
                aqui
            </div>
        </div>
    </main>



</body>
</html>