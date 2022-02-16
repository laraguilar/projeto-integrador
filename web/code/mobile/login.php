<?php

// connnecting to db
include "conexao.php";

// array for JSON response
$response = array();

$username = NULL;
$password = NULL;

// Método para mod_php (Apache)
if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
}
// Método para demais servers
elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
    if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION']))
		list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

// Se a autenticação não foi enviada
if(is_null($username)) {
    $response["success"] = 0;
	$response["error"] = "faltam parametros";
}
// Se houve envio dos dados
else {
    $query = mysqli_query($conn, "SELECT senha FROM empresa WHERE email='$username'");

	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_array($query);
		if(password_verify($password, $row['senha'])){
			$response["success"] = 1;
			
		}
		else {
			// senha ou usuario nao connfere
			$response["success"] = 0;
			$response["error"] = "usuario ou senha não confere";
		}
	}
	else {
		// senha ou usuario nao connfere
		$response["success"] = 0;
		$response["error"] = "usuario ou senha não confere";
	}
}

mysqli_close($conn);
echo json_encode($response);
?>