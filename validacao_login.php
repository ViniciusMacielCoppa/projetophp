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

            if($row > 0){
                $amz = mysqli_fetch_assoc($resultado);

                $_SESSION['usuario'] = [
                    'nome' => $amz['user_name'],
                    'status' => $amz['user_status'],
                    'id' => $amz['user_id'],
                    'autenticado' => true
                ];

                if($amz['user_status'] == 1){
                    $_SESSION['usuario']['permissoes'] = [
                        //por as permições de CEO
                        'criar usuario' => true,
                        'apagar noticias' => true,
                        'criar noticias' => true
                    ];

                }
                elseif($amz['user_status'] == 2){
                    $_SESSION['usuario']['permissoes'] = [
                        //por as permições de JORNALISTA
                        'criar usuario' => false,
                        'apagar noticias' => true,
                        'criar noticias' => true
                    ];
                }
                elseif($amz['user_status'] == 3){
                    $_SESSION['usuario']['permissoes'] = [
                        //por as permições de STAFF
                        'criar usuario' => false,
                        'apagar noticias' => true,
                        'criar noticias' => true
                    ];
                }
                else{
                    $_SESSION['usuario']['permissoes'] = [
                    'criar usuario' => false,
                    'apagar noticias' => false,
                    'criar noticias' => false
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
            echo "precisa digitar um usuario";
            $_SESSION['usuario']['autenticado'] = false;
            header("location: login.php");
        }
    }else{
        header("location: login.php");
    }
?>