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
	$response["success"] = 1;

	$estacionamentos = array();

    $idEstac = $_POST['idEstac'];


	// codigo sql da sua consulta
	$query1 = mysqli_query($conn, "SELECT * from vaga where idEstac = '$idEstac'");

    if (mysqli_num_rows($query1) > 0) {
        $response["alocados"] = array();
        // percorre as vagas do estacionamento
        while($vaga = mysqli_fetch_array($query1)):     

            

            // verifica se a vaga está ocupada
            $idVaga = $vaga['idVaga'];
            
            // pega os dados da vaga alocada
            $sql2 = "SELECT * FROM aloca WHERE idVaga = '$idVaga' and hrSaida IS NULL;";
            $query2 = mysqli_query($conn, $sql2);

            if(mysqli_num_rows($query2)){
                // percorre e printa os carros alocados no momento
                while($aloca = mysqli_fetch_array($query2)):
                    $alocado = array();
                    
                    $query = mysqli_query($conn, "SELECT idVaga FROM vaga WHERE idEstac = '$idEstac'");
                    $vaga = array();
                    $id = 1;
                    while($resultado = mysqli_fetch_array($query)){
                        $idVaga = $resultado['idVaga'];
                        $vaga[$idVaga] = $id;
                        $id ++;
                    }
                    

                    $alocado['idAloca'] = $aloca['idAloca'];
                    $alocado['idVaga'] = $vaga[$aloca['idVaga']];
                    $alocado['nomCliente'] = $aloca['nomCliente'];
                    $alocado['cpfCliente'] = $aloca['cpfCliente'];
                    $alocado['hrEntrada'] = $aloca['hrEntrada'];
                    $alocado['dscPlaca'] = $aloca['dscPlaca'];

                    array_push($response["alocados"], $alocado);

                endwhile;
            }

        endwhile;
        // Caso haja produtos no BD, o cliente 
        // recebe a chave "success" com valor 1.
        $response["success"] = 1;
        
        // Converte a resposta para o formato JSON.
        echo json_encode($response);
        
    } else {
        // Caso nao haja produtos no BD, o cliente 
        // recebe a chave "success" com valor 0. A chave "message" indica o 
        // motivo da falha.
        $response["success"] = 0;
        $response["message"] = "Nao ha produtos";
        
        // Fecha a conexao com o BD
     
        // Converte a resposta para o formato JSON.
        echo json_encode($response);
    }

} else {
	$response["success"] = 0;
	$response["error"] = "falha de autenticação";
}
mysqli_close($conn);
echo json_encode($response);