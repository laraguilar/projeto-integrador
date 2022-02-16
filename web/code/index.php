<?php
// Mensagem
include 'includes/message.php';
// conexão BD
include_once 'php_actions/conexao.php';
//header
include_once 'includes/headerDeslog.html'; 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Estacioney</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">   
        <link rel="shortcut icon" type="imagex/png" href="imagem/logo_estacioney50px.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>

        <div class="container" style="margin: auto; width: 60%;">
            <div class="row">
                <form method="POST" action="php_actions/loginDB.php" class="col s12 m6" style="margin-left: 50%; margin-right:50%; transform: translate(-50%, 0%);">
                    <h2 style="text-align: center;">Login</h2>
                    <div class="row center-align">
                        <div class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                <input type="email" name="Email" id="email" class="validate">
                                    <label for="email">Email</label>
                                    <span class="helper-text left-align" data-error="Email inválido" data-success="">Digite o email cadastrado</span>
                                </div>
                                <div class="input-field col s12">
                                <input type="password" name="Senha" id="password" class="validate">
                                    <label for="password">Senha</label>
                                </div>
                                <!-- <a href="esqueciSenha.php">Esqueci minha senha</a><br>-->
                            </div>
                            <button type="submit" name="btnEntrar" class="waves-effect waves-light btn indigo darken-2">Entrar</button><br><br>
                            <a href="cadEmpresa.php">Cadastrar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="main.js"></script>
        <?php 
        include_once 'includes/footer.php';?>
    </body>
  </html>