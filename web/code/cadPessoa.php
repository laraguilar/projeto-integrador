<?php
// conexão BD
include_once 'php_actions/conexao.php';
// sessao
require_once 'php_actions/sessaoLog.php';
//header
include_once 'includes/headerLog.php';

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
            <form action="php_actions/cadPessoaDB.php" method="POST" class="col s12 m6" name="cadEmpresa" style="margin-left: 50%; margin-right:50%; transform: translate(-50%, 0%);">
                <h3 style="text-align: center;">Cadastro do Cliente</h3>
                <div class="row center-align">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="nomCliente" id="nomCliente" class="validate" autofocus>
                                <label for="text">Nome do Cliente</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" name="cpfCliente" id="cpfCliente" class="validate">
                                <label for="text">CPF</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="date" name="datNasc" id="datNasc" class="validate">
                                <label for="text">Data de Nascimento</label>
                            </div>
                            <div class="input-field col s12">
                                <label for="radio">Sexo</label><br>
                                <p>
                                <label>
                                    <input name="sexo" type="radio" value="F" checked />
                                    <span>Feminino</span>
                                </label>
                                </p>
                                <p>
                                <label>
                                    <input name="sexo" type="radio" value="M" />
                                    <span>Masculino</span>
                                </label>
                                </p>
                                <p>
                                <label>
                                    <input name="sexo" type="radio" value="nb" />
                                    <span>Não Binário</span>
                                </label>
                                </p>
                            </div>
                        </div>
                        <button type="submit" name="btnCadPessoa" class="waves-effect waves-light btn indigo darken-2">Cadastrar</button>
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