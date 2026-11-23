<?php 
    session_start();
    
    if(isset($_POST['enviar'])){
        $nome = trim($_POST['nome']);
        $senha = trim($_POST['senha']);
        
        if(!(empty($nome) || empty($senha))){
            require "conexao.php";
            
            $sql = "SELECT * FROM usuarios WHERE user_name = '$nome' AND user_senha = '$senha'";

            $resultado = mysqli_query($conexao, $sql);
            $row = mysqli_num_rows($resultado);
            $amz = mysqli_fetch_assoc($resultado);

            if($amz['user_ativo'] == 1){

                if($row > 0){
                    $_SESSION['usuario'] = [
                        'nome' => $amz['user_name'],
                        'status' => $amz['user_status'],
                        'id' => $amz['user_id'],
                        'autenticado' => true
                    ];

                    if($amz['user_status'] == 'Ceo'){
                        $_SESSION['usuario']['permissoes'] = [
                            //por as permições de CEO
                            'criar usuario' => true,
                            'apagar noticias' => true,
                            'criar noticias' => true,
                            'gerenciar usuarios' => true,
                            'deletar user' => true
                        ];
                    }
                    elseif($amz['user_status'] == 'Jornalista'){
                        $_SESSION['usuario']['permissoes'] = [
                            //por as permições de JORNALISTA
                            'criar usuario' => false,
                            'apagar noticias' => true,
                            'criar noticias' => true,
                            'gerenciar usuarios' => false,
                            'deletar user' => false
                        ];
                    }
                    elseif($amz['user_status'] == 'Staff'){
                        $_SESSION['usuario']['permissoes'] = [
                            //por as permições de STAFF
                            'criar usuario' => false,
                            'apagar noticias' => true,
                            'criar noticias' => true,
                            'gerenciar usuarios' => true,
                            'deletar user' => false
                        ];
                    }
                    else{
                        $_SESSION['usuario']['permissoes'] = [
                        'criar usuario' => false,
                        'apagar noticias' => false,
                        'criar noticias' => false,
                        'gerenciar usuarios' => false,
                        'deletar user' => false
                        ];
                    }

                    header("location: painelHome.php");
                    exit(); 
                }else{
                    echo "n deu";
                    $_SESSION['usuario']['autenticado'] = false;
                    header("location: login.php");
                }
            }else{
                header("location: login.php");
                exit();
            }
        }else{
            echo "precisa digitar um usuario";
            $_SESSION['usuario']['autenticado'] = false;
            header("location: login.php");
        }
    }else{
        header("location: login.php");
    }
?>