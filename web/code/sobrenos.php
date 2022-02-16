<?php

session_start();
if(isset($_SESSION['logado'])){
    include_once 'includes/headerLog.php';
}else{
    include_once 'includes/headerDeslog.php';
}

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
                <div class="col s12">
                    <div class="row">
                        <div class="col s12">
                            <h2 style="text-align: center;">Sobre nós</h2>
                            <p class="flow-text" style="text-align: justify; font-size:medium;">Este website foi desenvolvido durante o curso de Informática para Internet por estudantes do IFES. Ele traz a proposta de facilitar o gerenciamento de estacionamentos por meio de uma interface visual. Sendo assim, visamos que o dia a dia dos gerentes e motoristas que utilizam estacionamentos rotativos se torne mais prático e rápido, além de contribuir para um trânsito com maior fluidez.</p>
                            <h4>Equipe de Desenvolvimento</h4><br>
                            <h5>Guilherme Silveira</h5>
                            <p class="flow-text" style="text-align: justify; font-size:medium;">
                            Estudante de Informática para Internet no Instituto Federal do Espírito Santo, Guilherme tem um grande apreço por tecnologia, com foco em hardware, sempre teve curiosidade em saber como as coisas funcionam. Pretende cursar jornalismo no futuro.
                            </p>

                            <h5>Lara Aguilar</h5>
                            <p class="flow-text" style="text-align: justify; font-size:medium;">
                            Estudante de Informática para Internet no Instituto Federal do Espírito Santo, Lara Aguilar tem um processo criativo voltado para arte, desde pinturas e cadernos, até a criação de sites e aplicativos. Pretende estudar design no futuro.</p>
                        </div>
                    </div>

                </div>
                    
            </div>
        </div>

        <?php include_once 'includes/footer.php' ?>
    </body>
    </html>