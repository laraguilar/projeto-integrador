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
	$query = mysqli_query($conn, "SELECT senha, idEmpresa FROM empresa WHERE email='$username'");

	if (mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_array($query);
		if (password_verify($password, $row['senha'])) {
			$isAuth = true;
		}
	}
}

if ($isAuth) {
	if(isset($_POST['idEstac']) && isset($_POST['nomCliente']) && isset($_POST['cpfCliente']) && isset($_POST['placa']) && isset($_POST['vaga'])):
        $idEstac = $_POST['idEstac'];
        $nomCliente = $_POST['nomCliente'];
        $cpfCliente = $_POST['cpfCliente'];
        $placa = $_POST['placa'];
        $vagaCarro = $_POST['vaga'];

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
            // verifica se a vaga esta desocupada
            $vagaVazia = "SELECT condVaga FROM vaga WHERE idVaga = $idVagaBD";
            $query = mysqli_query($conn, $vagaVazia);
            $result = mysqli_fetch_assoc($query);
            if($result['condVaga']):
                $response["success"] = 0;
	            $response["error"] = "Vaga ocupada";
            else:
                $sql = "INSERT INTO aloca (idVaga, hrEntrada, dscPlaca, nomCliente, cpfCliente) VALUES ('$idVagaBD', NOW(), '$placa', '$nomCliente', '$cpfCliente');";

                if(mysqli_query($conn, $sql)){
	                $response["success"] = 1;
                } else{
                    $response["success"] = 0;
                    $response["error"] = "Não foi possível cadastrar a vaga";
                }
            endif;
        }
    endif;
} else {
	$response["success"] = 0;
	$response["error"] = "falha de autenticação";
}
echo json_encode($response);
