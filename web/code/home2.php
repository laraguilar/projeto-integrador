<?php 
include_once 'php_actions/conexao.php';
// header
include_once 'includes/headerLog.php';
// sessao 
require_once 'php_actions/sessaoLog.php';

$_SESSION['idVagaSelect'] = $_SESSION['idVagaSelect'] ?? NULL;
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
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // funcao que percebe o evento de clique no item do dropdown
                $(".liberar").click(function() {
                    var idClicado = $(this).attr('id'); // pega o ID da vaga selecionada
                    
                    $.post("liberarvaga.php", {id : idClicado}, function(){});
                });
            });
        </script>   
        <style>
            .botao-lista{
                display: block;
                top:50%; 
            }
        </style>
</head>
<body>
    <div class="container" style="margin: auto; width: 60%;">
        <div class="row">
            <div class="col center-align">
            <div class="row s12 m6 center-align">
                <div class="col s12 z-depth-1">
                    <h4 class="center"><?php echo $nomEstac?></h4>
                    <!-- Dropdown Trigger
                    <a class='dropdown-trigger btn' href='#' data-target='dropdown2'>DROPDOWN??<?php //echo $dadosEstac['nomEstac']?><i class="material-icons right">arrow_drop_down</i> </a>

                    Dropdown Structure -->
                    <?php
                        /*$_SESSION['idEstacSelected'] = NULL;
                        // mostra a lista de estacionamentos da empresa
                        $sql = "SELECT * FROM estacionamento WHERE idEmpresa = $id";
                        $result = mysqli_query($conn, $sql);
                        // cria a tabela
                        echo "<form action='php_actions/teste.php' method='POST'> <ol id='dropdown2' class='dropdown-content'>";
                        // faz um while que mstra a informação de todos os estacionamentos da empresa
                        while($dado = mysqli_fetch_array($result)):
                            $idEstac = $dado['idEstac'];

                            if(!($dadosEstac['idEstac'] == $idEstac)){
                                echo "<button type='submit' id=".$idEstac." name='entrarEstac'>";
                                echo $dado['nomEstac'];
                                echo "</button>";
                            }  
                        endwhile;
                        echo "</ol></form>";*/
                    ?>

                    <div class="row center">
                        <div class="col s12 m6">
                            <h6><b>Valor fixo:</b> R$<?php echo number_format($valFixo, 2);?></h6>
                        </div>
                        <div class="col s12 m6">
                            <?php 

                                // calcula a quantidade de vagas ocupadas
                                $sql3 = "SELECT count(*) as 'vagasOcup' from vaga where condVaga = 1 and idEstac ='$idEstac'";
                                $query3 = mysqli_query($conn, $sql3);
                                $resulta = mysqli_fetch_assoc($query3);
                                $vagasOcup = $resulta['vagasOcup'];

                                // quantidade de vagas disponíveis
                                $vagasDisp = $qtdVagas - $vagasOcup;
                            ?>
                            <h6><b>Disponibilidade:</b> <?php echo $vagasDisp."/".$qtdVagas ?></h6>
                        </div>
                        <div class="col s12 m6">
                            <h6><b>Acréscimo/hora:</b> R$<?php echo number_format($valAcresc, 2);?></h6>
                        </div>
                        <div class="col s12 m6">
                            <a href="entrada.php" class="btn indigo darken-4">entrada veiculo</a>
                        </div>
                        <div class="col s12 left-align">
                            <br>
                            <div class="row">
                            <div class='divider'></div>
                            <div class="col s12">
                                <?php
                                    // pega dados da vaga
                                    $sql = "SELECT * FROM vaga WHERE idEstac = '$idEstac';";
                                    $query = mysqli_query($conn, $sql);

                                    // percorre as vagas do estacionamento
                                    while($vaga = mysqli_fetch_array($query)):     

                                        // verifica se a vaga está ocupada
                                        $idVaga = $vaga['idVaga'];
                                        $condVaga = $vaga['condVaga'];

                                        // pega os dados da vaga alocada
                                        $sql2 = "SELECT * FROM aloca WHERE idVaga = '$idVaga';";
                                        $query2 = mysqli_query($conn, $sql2);

                                        while($aloca = mysqli_fetch_array($query2)):
                                            $nomCliente = $aloca['nomCliente'];

                                            $idVaga = $vaga['idVaga'];

                                            // dados do cliente que alocou a vaga
                                            $hrEntrada = $aloca['hrEntrada'];
                                            echo "<div class='row'>";
                                                echo "<div class='section'>";
                                                    echo "<div class='col s8'>";
                                                        echo "<h5>".$nomCliente."</h5><span>Hora de Entrada: ".$hrEntrada."</span><br><span>Placa: ".$aloca['dscPlaca']."</span>";
                                                    echo "</div>";
                                                    echo "<div class='section'>";
                                                        echo "<div class='col s4'>";
                                                            echo "<div class='botao-lista right-align'>";
                                                                echo "<form action='' method='POST' name='liberarVaga'";
                                                                    echo "<input type='text' name='vaga' value=".$idVaga.">";
                                                                    echo "<button type='submit' class='btn orange liberar' id=".$idVaga." name='btnLiberar'>liberar vaga</button>";
                                                                echo "</form>";
                                                            echo "</div>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</div>";
                                            echo "<div class='divider'></div>";                                            
                                        endwhile;
                                    endwhile;
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="main.js"></script>

        <?php  'includes/footer.php';?>

    </body>

  </html>