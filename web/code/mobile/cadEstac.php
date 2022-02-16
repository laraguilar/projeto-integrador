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
	if(isset($_POST['nomEstac']) && isset($_POST['qtdVagas']) && isset($_POST['valFixo']) && isset($_POST['valAcresc']) && isset($_POST['cep']) && isset($_POST['rua']) && isset($_POST['num']) && isset($_POST['bairro']) && isset($_POST['cidade']) && isset($_POST['estado'])):
        
        // pega id Empresa
        $query = mysqli_query($conn, "SELECT idEmpresa from empresa where email='$username'");
        $empresa = mysqli_fetch_assoc($query);
        $idEmpresa = $empresa['idEmpresa'];

        // pega os dados do post
        $nomEstac = $_POST['nomEstac'];
        $qtdVagas = $_POST['qtdVagas'];
        $valFixo = $_POST['valFixo'];
        $valAcresc = $_POST['valAcresc'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $num = $_POST['num'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        // verifica se o estacionamento com o nome ja existe
        $query2 = mysqli_query($conn, "SELECT idEstac FROM estacionamento WHERE idEmpresa = $idEmpresa and nomEstac = '$nomEstac';");
        $row = mysqli_fetch_array($query2);
        if($row > 0):
            $response["success"] = 0;
	        $response["error"] = "nome do estacionamento ja existe";
        
        
        else:
            
            
            // cria o estacionamento no bd
            $sql = "INSERT INTO estacionamento (nomEstac, qtdVagas, valFixo, valAcresc, idEmpresa) VALUES ('$nomEstac', '$qtdVagas', '$valFixo', '$valAcresc', '$idEmpresa');";

            if(mysqli_query($conn, $sql)){
                // pega o ID do estacionamento
                $query = mysqli_query($conn, "SELECT idEstac, qtdVagas from estacionamento WHERE idEmpresa = '$idEmpresa' and nomEstac = '$nomEstac';");
                $resultQuery = mysqli_fetch_array($query);
                $idEstac = $resultQuery['idEstac'];

                $sql2 = "INSERT INTO endereco (dscLogradouro, numero, cep, bairro, cidade, estado, idEstac) VALUES ('$rua', '$num', '$cep', '$bairro', '$cidade', '$estado', '$idEstac');";

                if(mysqli_query($conn, $sql2)){
                    $qtdVaga = $resultQuery['qtdVagas'];

                    for($i=0; $i < $qtdVaga; $i++){
                        $sql3 = "INSERT INTO vaga (condVaga, idEstac) VALUES (0, '$idEstac')";
                        mysqli_query($conn, $sql3);
                    }
                    $response["success"] = 1;
                } else{
                    $response["success"] = 0;
                    $response["error"] = "falha no cadastro do endereço";
                }
            } else{
                $response["success"] = 0;
                $response["error"] = "falha no cadastro da empresa";
            }
        endif;

    endif;
} else {
	$response["success"] = 0;
	$response["error"] = "falha de autenticação";
}
echo json_encode($response);
