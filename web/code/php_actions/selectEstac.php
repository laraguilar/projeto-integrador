<?php
include_once './conexao.php';
session_start();

if(isset($_POST['btnEntrarEstac'])){
    $idEstac = $_POST['idEstac'];

    $_SESSION['idEstac'] = $idEstac;

    header('Location: ../home.php');
}
?>