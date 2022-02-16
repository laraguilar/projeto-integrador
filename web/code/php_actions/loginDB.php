<?php 
// Sessão
session_start();
// Conexão DB
include_once './conexao.php';
//
if(isset($_POST['btnEntrar'])):
    $email = mysqli_escape_string($conn, $_POST['Email']);
    $senha = mysqli_escape_string($conn, $_POST['Senha']);

    if (empty($email) or empty($senha)):
        header('Location: ../index.php');
        $_SESSION['mensagem'] = "Campo Email/Senha precisa ser preenchido";
    else:
        $sql = "SELECT * FROM empresa WHERE email = '$email';";
        $resultado = mysqli_query($conn, $sql);

        // verifica se o email esta cadastrado
        if(mysqli_num_rows($resultado) > 0):
            
            // verifica senha criptografada
            $sqlSenha = "SELECT senha FROM empresa WHERE email = '$email'";
            $query = mysqli_query($conn, $sqlSenha);
            $resultQuery = mysqli_fetch_assoc($query);
            $senhaCripto = $resultQuery['senha'];

            if(password_verify($senha, $senhaCripto)): // se a senha esta correta, roda o codigo
                
                // verifica se o email esta correto
                $sql = "SELECT * FROM empresa WHERE email = '$email'";
                $resultado = mysqli_query($conn, $sql);

                if(mysqli_num_rows($resultado) > 0):
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['idEmpresa'];
                    $id = $dados['idEmpresa'];
                    
                    // verifica se tem estacionamentos cadastrados
                    $sql2 = "SELECT * FROM estacionamento WHERE idEmpresa = '$id'";
                    $query2 = mysqli_query($conn, $sql2);


                    if(mysqli_num_rows($query2) > 0):

                        // Log na Sessao
                        $sql3 = "SELECT * FROM estacionamento WHERE idEmpresa = '$id'";
                        $query3 = mysqli_query($conn, $sql3);
                        
                        $arr = array();

                        while($dadosEstac = mysqli_fetch_array($query3)):
                            $arr[] = $dadosEstac['nomEstac'];
                        endwhile;

                        $_SESSION['dadosEstac'] = $arr;

                        header('Location: ../listEstacs.php');
                    else:
                        header('Location: ../listEstacs.php');
                    endif;
                else:
                    header('Location: ../index.php');
                    $_SESSION['mensagem'] = "Usuário e Senha não conferem";
                endif;
            else:
                header('Location: ../index.php');
                $_SESSION['mensagem'] = "Usuário não cadastrado no sistema";
            endif;
        else:
            $_SESSION['mensagem'] = "Email não cadastrado no sistema";
            header('Location: ../index.php');
        endif;
    endif;
endif;