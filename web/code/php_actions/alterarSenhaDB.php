<?php 
// Sessão
session_start();
// Conexão DB
require_once './conexao.php';

if(isset($_POST[' btnAlterarSenha'])):

    $senha = mysqli_escape_string($conn, $_POST['Senha']);
    $nova_senha = mysqli_escape_string($conn, $_POST['Newpassword']);

    $sql = "UPDATE empresa SET senha = '$nova_senha' WHERE senha = '$senha'";


    if(mysqli_query($conn, $sql)):
        $_SESSION['mensagem'] = "Senha alterada com sucesso!";
        header('Location: ../cadEstac.php');
    else:
        header('Location: ../cadEmpresa.php');
        $_SESSION['mensagem'] = "Erro ao alterar senha";
    endif;



endif;