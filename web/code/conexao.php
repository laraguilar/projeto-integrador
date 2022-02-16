<?php
$host = "l6glqt8gsx37y4hs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$user = "ejxmaj2pnpt8e86z";
$pass ="b147ao62taewthjc";
$db = "jmukadihhslhvhya";
$port = 3306;

$conn = new PDO("mysql:host=$host; port=$port; dbname=" . $db, $user, $pass);



if(mysqli_connect_error()):
    echo "Falha na conexão: ". mysqli_connect_error();
endif;


?>