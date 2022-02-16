<?php
// conexão BD
include_once 'php_actions/conexao.php';
//header
include_once 'includes/headerDeslog.html';
// Mensagem
include_once 'includes/message.php';
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
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="container" style="margin: auto; width: 60%;">
        <div class="row">
            <form action="php_actions/cadEmpresaDB.php" method="POST" class="col s12 m6" name="cadEmpresa" style="margin-left: 50%; margin-right:50%; transform: translate(-50%, 0%);">
                <h3 style="text-align: center;">Cadastro da Empresa</h3>
                <div class="row center-align">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="nomEmpresa" id="nomEmpresa" class="validate" autofocus>
                                <label for="text">Nome da Empresa</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" name="dscCpfCnpj" id="dsccpfcnpj"  class="validate">
                                <label for="text">CPF ou CNPJ</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="tel" name="Telefone" id="telefone" class="validate">
                                <label for="text">Telefone</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="email" name="Email" id="email" class="validate">
                                <label for="email">Email</label>
                                <span class="helper-text left-align" data-error="Email inválido" data-success="">Digite um email válido</span>
                            </div>
                            <div class="input-field col s12">
                                <input type="password" name="Senha" id="password" class="validate">
                                <label for="password">Senha</label>
                                <span class="helper-text left-align" data-error="Senha inválida" data-success="">Mínimo 8 caracteres</span>
                            </div>
                            <div class="input-field col s12">
                                <input type="password" name="Confirmar" id="confirmar" class="validate">
                                <label for="password">Confirmar Senha</label>
                                <span class="helper-text left-align" data-error="Senha inválida" data-success="">Mínimo 8 caracteres</span>
                            </div>
                        </div>
                        <button type="submit" name="btnCadEmpresa" class="waves-effect waves-light btn indigo darken-2">Cadastrar</button>
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