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
            <p><?php echo $nomeLogado;?></p>
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
                        <input type="text" name="pesquisa" placeholder="Filter" maxlength="100">
                        <i class="fa-solid fa-magnifying-glass filter"></i>
                    </form>
                    <?php if($_SESSION['usuario']['permissoes']['criar usuario']):?>
                        <a href="painelCadastroUser.php" id="ButtonNew">+ Criar novo usuário</a>
                    <?php endif; ?>
                </div>
                <div class="listra"></div>
                <div>
                    <div id="containerheader">
                        <h2>NAME</h2>
                        <h2>ROLE</h2>
                        <?php if($_SESSION['usuario']['permissoes']['gerenciar usuarios']):?>
                            <h2>ADMINISTRAR</h2>
                        <?php endif; ?>
                    </div>
                    <div class="listra"></div>
                        <?php 
                            if(isset($_POST['pesquisa'])){
                                $busca = $_POST['pesquisa'];
                            }else{
                                $busca = '';
                            }

                            $sql = "SELECT * FROM usuarios WHERE user_name LIKE ? OR user_status LIKE ?";

                            $busca_sql = "%$busca%";
                            $stmt = mysqli_prepare($conexao, $sql);
                            mysqli_stmt_bind_param($stmt, "ss", $busca_sql, $busca_sql);
                            mysqli_stmt_execute($stmt);
                            $resultado = mysqli_stmt_get_result($stmt);
                            $linhas = mysqli_num_rows($resultado);

                            for($i=0; $i<$linhas; $i++){
                                $amz = mysqli_fetch_array($resultado);

                                echo "<div id='containerheader'>";
                                echo "<p>".$amz['user_name']."</p>";
                                echo "<p>".$amz['user_status']."</p>";
                                if($_SESSION['usuario']['permissoes']['gerenciar usuarios']){
                                    echo "<form action='gerenciarUsuarios.php' method='POST'>";
                                    echo "<button type='submit' name='enviar' id='buttonEdit'><i class='fa-solid fa-gear'></i></button>";
                                    echo "<input readonly type='hidden' name='id_user' value='".$amz['user_id']."'>";
                                    echo "</form>";
                                }
                                echo "</div>";
                                echo "<div class='listra'></div>";
                            }
                        ?>
                </div>
            </div>
        </div>
    </main>



</body>
</html>