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

    $query = mysqli_query($conn, "SELECT idEmpresa from empresa where email='$username'");
	$empresa = mysqli_fetch_assoc($query);
	$idEmpresa = $empresa['idEmpresa'];


	// codigo sql da sua consulta
	$query1 = mysqli_query($conn, "SELECT * from estacionamento where idEmpresa = '$idEmpresa'");

    if (mysqli_num_rows($query1) > 0) {
        // Caso existam produtos no BD, eles sao armazenados na 
        // chave "products". O valor dessa chave e formado por um 
        // array onde cada elemento e um produto.
        $response["estacionamentos"] = array();
     
        while ($row = mysqli_fetch_array($query1)) {
            // Para cada produto, sao retornados somente o 
            // pid (id do produto) e o nome do produto. Nao ha necessidade 
            // de retornar nesse momento todos os campos de todos os produtos 
            // pois a app cliente, inicialmente, so precisa do nome do mesmo para 
            // exibir na lista de produtos. O campo pid e usado pela app cliente 
            // para buscar os detalhes de um produto especifico quando o usuario 
            // o seleciona. Esse tipo de estrategia poupa banda de rede, uma vez 
            // os detalhes de um produto somente serao transferidos ao cliente 
            // em caso de real interesse.
            $estacionamento = array();
            $estacionamento["nomEstac"] = $row["nomEstac"];
            $estacionamento["idEstac"] = $row["idEstac"];
            
            
            $idEstac = $row["idEstac"];
            $query2 = mysqli_query($conn, "SELECT * FROM endereco WHERE idEstac = '$idEstac'");
            if(mysqli_num_rows($query2) > 0){


                while($row = mysqli_fetch_array($query2)){

                    $estacionamento["cep"] = $row["cep"];
                    $estacionamento["logr"] = $row["dscLogradouro"];
                    $estacionamento["num"] = $row["numero"];
                }
            }

            // Adiciona o produto no array de produtos.
            array_push($response["estacionamentos"], $estacionamento);
        }
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