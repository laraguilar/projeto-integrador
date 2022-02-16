<?php
include_once 'php_actions/conexao.php';
if ( session_status() != PHP_SESSION_ACTIVE )
 {
    session_start();
}

(!empty($_SESSION['logado'])) or die (header('Location: ../code/index.php'));

$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM empresa WHERE idEmpresa = '$id'";
$resultado = mysqli_query($conn, $sql);
$dados = mysqli_fetch_array($resultado);
$logado = $_SESSION['logado'];


if(isset($_SESSION['dadosEstac'])){
    $dadosEstac = $_SESSION['dadosEstac'];
}
?>