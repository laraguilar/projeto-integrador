<?php
$host = "exbodcemtop76rnz.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$user = "b7ruttu16hi4xna4";
$pass ="nfuldq9hoft92y1j";
$db = "ehd5xaw4hlk5mnfl";
$port = 3306;

$conn = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_error()):
    echo "Falha na conexão: ". mysqli_connect_error();
endif;
?>