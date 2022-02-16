<?php include_once 'includes/headerDeslog.html' ?>
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
                <form method="post" class="col s12 m6" style="margin-left: 50%; margin-right:50%; transform: translate(-50%, 0%);">
                    <h2 style="text-align: center;">Esqueci minha senha</h2>
                    <div class="row center-align">
                        <div class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="password" id="password" class="validate">
                                    <label for="password">Nova Senha</label>
                                    
                                </div>
                                <div class="input-field col s12">
                                    <input type="password" id="password" class="validate">
                                    <label for="password">Repita a Senha</label>
                                    <span class="helper-text left-align" data-error="As senhas não são iguais" data-success="">Repita a senha</span>
                                </div>
                            </div>
                            <a href="index.php" class="waves-effect waves-light btn">Confirmar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="main.js"></script>
    </body>
  </html>