<?php 
include_once 'php_actions/conexao.php';

$idEstac = 70;
$vagaCarro = 21;

$query4 = mysqli_query($conn, "SELECT idVaga FROM vaga WHERE idEstac = '$idEstac'");
$vaga = array();
$id = 1;
while($resultado = mysqli_fetch_array($query4)){
    $idVaga = $resultado['idVaga'];
    $vaga[$idVaga] = $id;
    $id ++;
}

if(in_array($vagaCarro, $vaga)){
    $arr = array_keys($vaga, $vagaCarro);
    $idVagaBD = $arr[0];
    var_dump($arr);
    echo $idVagaBD;
}
var_dump($vaga);
?>