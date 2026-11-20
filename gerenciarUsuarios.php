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
    <link rel="stylesheet" href="css/gerenciar_user.css">
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
                <li><a href="painelHome.php"><i class="fa-solid fa-house"></i>Home</a></li>
                <li><a href="painelUsuarios.php"><i class="fa-solid fa-users"></i>Usuários</a></li>
                <li><a href=""><i class="fa-solid fa-newspaper"></i>Notícias</a></li>
            </ul>
            <p>© Copyright vini259.</p>
        </nav>

        <div id="divmain">
            <h1>Gerenciar Usuário</h1>
            <div id="container">
                <?php 
                    $id_user = $_POST['id_user'];

                    $sql = "SELECT * FROM usuarios WHERE user_id = '$id_user'";

                    $resultado = mysqli_query($conexao, $sql);
                    $amz = mysqli_fetch_array($resultado);
                ?>
                <form action="gerenciar_mudancas.php" id="form_alteracao" method="POST">
                    <input type="text" name="changename" value="<?= $amz['user_name'] ?>" placeholder="Usuário: <?= $amz['user_name']?>">
                    <select name="status">
                        <option value="Ceo" <?= $amz['user_status'] == "Ceo" ? "selected" : "" ?>>Ceo</option>
                        <option value="Jornalista" <?= $amz['user_status'] == "Jornalista" ? "selected" : "" ?>>Jornalista</option>
                        <option value="Staff" <?= $amz['user_status'] == "Staff" ? "selected" : "" ?>>Staff</option>
                    </select>
                    <input readonly type='hidden' name='id_user' value="<?= $amz['user_id'] ?>">
                    <button type="submit" name="save" id="btnsalvar">Salvar Alterações</button>
                </form>
                <div id="container_buttons">
                    <button type="text" id="btnsenha">Resetar Senha</button>
                    <?php if($_SESSION['usuario']['permissoes']['deletar user']): ?>
                        <button type="text" id="btndeletar">Remover</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    
    <div id="reset_senha_div" class="sumir_div">
        <div id="div_all">
            <h3>Deseja resetar a senha?</h3>
            <i class="fa-solid fa-xmark" id="fechar1"></i>
            <p>Ao resetar a senha, o usuário deverá acessar sua conta com a nova senha "123456" e em seguida o mesmo será direcionado para alterar sua senha.</p>
            <form action="form_alteracao_senha" id="form_senha" method="POST">
                <button type="submit" name="change_password" id="btnsenha">Resetar Senha</button>
                <input readonly type='hidden' name='id_user' value="<?= $amz['user_id'] ?>">
            </form>
        </div>
    </div>
    <div id="delete_div" class="sumir_div">
        <div id="div_all">
            <h3>Deseja deletar este usuário?</h3>
            <i class="fa-solid fa-xmark" id="fechar2"></i>
            <p>Ao deletar este usuário, ele será totalmente apagado. Você tem certeza disso?</p>
            <form action="form_delete_user" id="form_delete" method="POST">
                <input readonly type='hidden' name='id_user' value="<?= $amz['user_id'] ?>">
                <button type="submit" name="delet_user" id="btndeletar">Remover</button>
            </form>
        </div>
    </div>

    <script>
        const btn_reset_senha = document.getElementById("btnsenha");
        const btn_fechar1 = document.getElementById("fechar1");
        
        btn_reset_senha.addEventListener("click", () => {
            document.getElementById("reset_senha_div").classList.remove("sumir_div");   
            document.getElementById("reset_senha_div").classList.add("aparecer_div");      
        })
        btn_fechar1.addEventListener("click", () => {
            document.getElementById("reset_senha_div").classList.remove("aparecer_div");   
            document.getElementById("reset_senha_div").classList.add("sumir_div");      
        })

        const btn_delete_user = document.getElementById("btndeletar");
        const btn_fechar2 = document.getElementById("fechar2");
        
        btn_delete_user.addEventListener("click", () => {
            document.getElementById("delete_div").classList.remove("sumir_div");   
            document.getElementById("delete_div").classList.add("aparecer_div"); 
        })
        btn_fechar2.addEventListener("click", () => {
            document.getElementById("delete_div").classList.remove("aparecer_div");   
            document.getElementById("delete_div").classList.add("sumir_div");      
        })
    </script>

</body>
</html>