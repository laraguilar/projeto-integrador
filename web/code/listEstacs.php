<?php 
// Log na Sessao
require_once 'php_actions/sessaoLog.php';
// header
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
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <div class="container" style="margin: auto; width: 60%;">
        <div class="row center">
            <div class="col s12 center">
                <div class="row center">
                    <div class="col s12 z-depth-1"> 
                        <h4 class="center">Lista de Estacionamentos</h4>
                            <a class="waves-effect waves-light btn-small indigo darken-4" href="cadEstac.php">Adicionar estacionamento</a><br><br>
                            <div class="divider"></div>
                            <div class="row center" style="margin-top: 2%;">
                                <?php
                                    $_SESSION['idEstacSelected'] = NULL;
                                    // mostra a lista de estacionamentos da empresa
                                    $sql = "SELECT * FROM estacionamento WHERE idEmpresa = $id";
                                    $result = mysqli_query($conn, $sql);
                                    // cria a tabela

                                    // faz um while que mstra a informação de todos os estacionamentos da empresa
                                    while($dado = mysqli_fetch_array($result)):
                                        $idEstac = $dado['idEstac'];

                                        $query = mysqli_query($conn, "SELECT * FROM endereco WHERE idEstac = $idEstac");
                                        $end = mysqli_fetch_assoc($query);

                                            ?>
                                                
                                                    <div class="col s6 m12 left-align">
                                                        <b><?php echo $dado['nomEstac']?></b>
                                                            <form action="php_actions/selectEstac.php" method="POST">
                                                                <input type="hidden" name="idEstac" value="<?php echo $idEstac ?>">
                                                                <button type="submit" name="btnEntrarEstac" class="btn-floating green right-align"><i class="material-icons">chevron_right</i></button>
                                                            </form>
                                                    </div>
                     
                                            <?php 
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="main.js"></script>
    </body>
  </html>