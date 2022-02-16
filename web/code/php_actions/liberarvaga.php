<?php
include_once './conexao.php';
session_start();

    if(isset($_POST['btnLiberar'])){
        //atribui os valores do formulario
        $idVaga = $_POST['id'];
        $idEstac = $_POST['idEstac'];

        $query = mysqli_query($conn, "SELECT valFixo, valAcresc FROM estacionamento WHERE idEstac = '$idEstac'");
        $result = mysqli_fetch_array($query);

        $valAcresc = $result['valAcresc'];
        $valFixo = $result['valFixo'];

        // código SQL para editar os dados
        $query2 = mysqli_query($conn, "SELECT hrEntrada FROM aloca WHERE idVaga = '$idVaga'");
        $hrEntrada = mysqli_fetch_assoc($query2);
        
        $hrEntrada = $hrEntrada['hrEntrada'];

        $query3 = mysqli_query($conn, "SELECT hour(TIMEDIFF(current_timestamp(), hrEntrada)) as 'tempEstac' FROM aloca WHERE idVaga = '$idVaga'");
        $tempoEstac = mysqli_fetch_assoc($query3);
        
        $tempoEstac = $tempoEstac['tempEstac'];

        if($tempoEstac = 0){
            $tempoEstac = 0;
        } else{
            $tempoEstac = $tempoEstac['tempEstac']-1;
        }

        $custo = $valFixo + ($valAcresc * $tempoEstac);

        $sql1 = "UPDATE aloca SET hrSaida = current_timestamp(), valTotal = '$custo' WHERE idVaga = '$idVaga';";

        $sql2 = "UPDATE vaga SET condVaga = 0 WHERE idVaga='$idVaga';";

        if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
            header('Location: ../home.php');
        }

    }

?>