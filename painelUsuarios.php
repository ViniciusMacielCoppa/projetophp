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
    <link rel="stylesheet" href="css/painelusuarios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.css" integrity="sha512-x9WwyMYBnlXMNQ6kQ/Lyzu1NqIhLQKL5Oq6xByfXuRj7s9CskyCbLv/1IjqzJmXwFXWr0ov6jBV7Qbc0hh9nHg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>USUARIOS</title>
</head>
<body>
    <header>
        <h1>Painel HK</h1>
        <div id="divheader">
            <!-- <img src="" alt="foto"> -->
            <p><?php echo $nome;?></p>
            <a href="deslogar.php">sair</a>
        </div>
    </header>

    <main>
        <nav>
            <ul>
                <li><a href="painelHome.php"><i class="fa-solid fa-house"></i>Home</a></li>
                <li><a href="painelUsuarios.php"><i class="fa-solid fa-users"></i>Usuários</a></li>
                <li><a href=""><i class="fa-solid fa-newspaper"></i>Notícias</a></li>
            </ul>
            <p>© Copyright vini259.</p>
        </nav>

        <div id="divmain">
            <h1>Usuários</h1>
            <div id="container">
                <div id="containerForms">
                    <form action="" method="POST">
                        <input type="text" name="pesquisa" placeholder="filter" maxlength="100">
                        <i class="fa-solid fa-magnifying-glass filter"></i>
                    </form>
                    <?php if($_SESSION['usuario']['permissoes']['criar usuario']):?>
                        <a href="painelCadastroUser.php" id="ButtonNew">+ Criar novo usuário</a>
                    <?php endif; ?>
                </div>
                <div class="listra"></div>
            </div>
        </div>
    </main>



</body>
</html>