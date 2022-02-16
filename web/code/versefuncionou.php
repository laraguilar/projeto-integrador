<?php 
// Log na Sessao
require_once 'php_actions/sessaoEstac.php';
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
<div class="input-field col s12">
<a class='dropdown-trigger btn' href='#' data-target='dropdown2'><?php echo $dadosEstac['nomEstac']?><i class="material-icons right">arrow_drop_down</i> </a>
<?php
                        $_SESSION['idEstacSelected'] = NULL;
                        // mostra a lista de estacionamentos da empresa
                        $sql = "SELECT * FROM estacionamento WHERE idEmpresa =".$id;
                        $result = mysqli_query($conn, $sql);
                        // cria a tabela
                        echo "<form action='php_actions/teste.php' method='POST'> <ol id='dropdown2' class='dropdown-content'>";
                        // faz um while que mstra a informação de todos os estacionamentos da empresa
                        $dado = mysqli_fetch_array($result);
                        $idEstac = $dado[0];

                            echo "<button type='submit' id=".$idEstac." name='entrarEstac'>";
                                echo $dado['nomEstac'];
                                echo "</button>";

                            
                            
                        echo "</ol></form>";
                    ?>

</body>
</html>