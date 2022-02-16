<?php

// conecta ao BD
include_once "conexao.php";
session_start();

// array for JSON response
$response = array();

if (mysqli_connect_error()) :
	echo "Falha na conexão: " . mysqli_connect_error();
endif;
$username = NULL;
$password = NULL;

$isAuth = false;

// Método para mod_php (Apache)
if (isset($_SERVER['PHP_AUTH_USER'])) {
	$username = $_SERVER['PHP_AUTH_USER'];
	$password = $_SERVER['PHP_AUTH_PW'];
} // Método para demais servers
elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
	if (preg_match('/^basic/i', $_SERVER['HTTP_AUTHORIZATION']))
		list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

// Se a autenticação não foi enviada
if (!is_null($username)) {
	$query = mysqli_query($conn, "SELECT senha FROM empresa WHERE email='$username'");

	if (mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_array($query);
		if (password_verify($password, $row['senha'])) {
			$isAuth = true;
		}
	}
}

if ($isAuth) {
	$response["success"] = 1;

    $idEstac = $_POST['idEstac'];

    $query2 = mysqli_query($conn, "SELECT * FROM estacionamento WHERE idEstac = '$idEstac'");
    $result = mysqli_fetch_array($query2);

    if($result>0){

        $response['dadosEstac'] = array();

        $estacionamento = array();
		$estacionamento['nomEstac'] = $result['nomEstac'];
        $estacionamento['qtdVagas'] = $result['qtdVagas'];
        $estacionamento['valFixo'] = $result['valFixo'];
        $estacionamento['valAcresc'] = $result['valAcresc'];

		$sql3 = "SELECT count(*) as 'vagasOcup' from vaga where condVaga = 1 and idEstac ='$idEstac'";
		$query3 = mysqli_query($conn, $sql3);
		$resulta = mysqli_fetch_assoc($query3);
		$vagasOcup = $resulta['vagasOcup'];

		// quantidade de vagas disponíveis
		$vagasDisp = $estacionamento['qtdVagas'] - $vagasOcup;

		$disponibilidade = "Disponibilidade: ".$vagasDisp."/".$estacionamento['qtdVagas'];
		$estacionamento['vagasDisp'] = $disponibilidade; // add no array de estacionamento

		
        array_push($response["dadosEstac"], $estacionamento);


		// dados do aloca

		$alocados = array();

		


        $response["success"] = 1;

    } else{
        $response["success"] = 0;
	    $response["error"] = "não foi possível carregar os dados";
    }

} else {
	$response["success"] = 0;
	$response["error"] = "falha de autenticação";
}
echo json_encode($response);
