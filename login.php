<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <h1>Sistema de Login</h1>
    <?php if(isset($_SESSION['usuario']['autenticado'])): ?>
    <div>ERRO: Usuário ou senha inválidos.</div>
    <?php 
        endif;
        unset($_SESSION['usuario']);
    ?>
    <main>
        <form action="validacao_login.php" method="POST">
            <input type="text" name="nome" placeholder="Seu usuário">
            <input type="password" name="senha" placeholder="Sua senha">
            <button type="submit" name="enviar">Entrar</button>
        </form>
    </main>
</body>
</html>