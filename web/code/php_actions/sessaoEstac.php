<?php
include_once 'php_actions/conexao.php';
require_once 'sessaoLog.php';

// inicia sessoes
$_SESSION['estacLogado'] = $_SESSION['estacLogado'] ?? NULL;
$_SESSION['idEstacSelected'] = $_SESSION['idEstacSelected'] ?? NULL;

if($_SESSION['estacLogado'] = 1):
    if(empty($_SESSION['idEstacSelected'])){
        
    }



    // dados do estac
    $idEstacio = $_SESSION['idEstacSelected']; 
    $sql = "SELECT * FROM estacionamento WHERE idEstac = '$idEstacio'";
    $resultado = mysqli_query($conn, $sql);
    $dadosEstac = mysqli_fetch_array($resultado);

    //endereco do estac
    $sql = "SELECT * FROM endereco WHERE idEstac = '$idEstacio'";
    $resultado = mysqli_query($conn, $sql);
    $endereco = mysqli_fetch_array($resultado);

    //vagas do estacionamento
    $vagas = "SELECT * FROM vaga WHERE idEstac = '$idEstacio';";
    $queryVAGAS = mysqli_query($conn, $vagas);
    $vagas = mysqli_fetch_array($queryVAGAS);

    //$vagasEstac = array();

    /*foreach($vagas as $vaga){
        if(is_int(key($vaga))){
            $vagasEstac[] = key($vaga)+1;
        }
    }*/

endif;

function inserirEstac($conn, $id){
    $sql = "SELECT idEstac FROM estacionamento WHERE idEmpresa = '$id'";
    $resultado = mysqli_query($conn, $sql);
    $listEstac = mysqli_fetch_array($resultado);
    $_SESSION['estacLogado'] = true;
    $_SESSION['idEstacSelected'] = $listEstac[0];
    $idEstacio = $_SESSION['idEstacSelected'];
}

function mudarEstac($conn, $idEstac){
    $sql = "SELECT * FROM estacionamento WHERE idEmpresa = '$idEstac'";
    $resultado = mysqli_query($conn, $sql);
    $listEstac = mysqli_fetch_array($resultado);

    $_SESSION['idEstacSelected'] = $listEstac[0];
    $idEstacio = $_SESSION['idEstacSelected'];
}

?>