<?php
// sessao
require_once 'php_actions/sessaoLog.php';

//header
include_once 'includes/headerLog.php';


$idEstac = $_SESSION['idEstac'];

$query4 = mysqli_query($conn, "SELECT * FROM estacionamento WHERE idEstac = '$idEstac'");
$dadosEsta = mysqli_fetch_array($query4);

$nomEstac = $dadosEsta['nomEstac'];
$qtdVagas = $dadosEsta['qtdVagas'];
$valFixo = $dadosEsta['valFixo'];
$valAcresc = $dadosEsta['valAcresc'];


// pega os dados de endereço
$sql = "SELECT * FROM endereco WHERE idEstac = '$idEstac'";
$query = mysqli_query($conn, $sql);
$endEstac = mysqli_fetch_array($query);

$logr = $endEstac['dscLogradouro'];
$numero = $endEstac['numero'];
$cep = $endEstac['cep'];
$bairro = $endEstac['bairro'];
$cidade = $endEstac['cidade'];
$estado = $endEstac['estado'];
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
            <div class="col center-align">
                <div class="row s12 m6 center-align">
                    <div class="col s12 z-depth-1">
                        <h3 class="center">Dados do Estacionamento</h3>
                        <br>
                        <div class="row center">
                            <div class="col s12 left-align">
                                <!-- A partir de agora todas as cols são uma linha do "histórico"-->
                                <div class="row">
                                    <div class="divider"></div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="row">
                                            <!-- Cria duas colunas para os dados e os botoes ficarem na mesma linha e em sentidos opostos -->
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">Nome do Estacionamento</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p><?php echo $nomEstac ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">Quantidade de Vagas</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p><?php echo $qtdVagas; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">Valor Fixo</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p>R$<?php echo number_format($valFixo, 2); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">Valor Acrescimo</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p>R$<?php echo number_format($valAcresc, 2); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">Endereço</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p><?php echo $logr.", ".$numero." - ".$bairro;?></p>
                                                    <p><?php echo $cep." - ".$cidade." - ".$estado;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once 'includes/footer.php';?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="main.js"></script>

</body>
</html>