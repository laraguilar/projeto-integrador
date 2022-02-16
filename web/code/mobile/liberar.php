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
	if(isset($_POST['idAlocado']) && isset($_POST['valFixo'])):        
        $idAlocado = $_POST['idAlocado'];
        $valFixo = $_POST['idAlocado'];
        
        $query2 = mysqli_query($conn, "SELECT idVaga FROM aloca WHERE idAloca = '$idAlocado'");

        if(mysqli_num_rows($query2) > 0){
            $result = mysqli_fetch_array($query2);

            $idVaga = $result['idVaga'];
            // código SQL para editar os dados
            $query3 = mysqli_query($conn, "SELECT hrEntrada FROM aloca WHERE idVaga = '$idVaga'");
            
            if(mysqli_num_rows($query3)){
                $hrEntrada = mysqli_fetch_assoc($query3);
                $hrEntrada = $hrEntrada['hrEntrada'];

                $query3 = mysqli_query($conn, "SELECT hour(TIMEDIFF(current_timestamp(), hrEntrada)) as 'tempEstac' FROM aloca WHERE idAloca = '$idAlocado'");
                
                if(mysqli_num_rows($query3) > 0){
                    $tempoEstac = mysqli_fetch_assoc($query3);
                    $tempoEstac = $tempoEstac['tempEstac'];


                    if($tempoEstac = 0){
                        $tempoEstac = 0;
                    } else{
                        $tempoEstac = $tempoEstac['tempEstac']-1;
                    }

                    $query4 = mysqli_query($conn, "SELECT idEstac FROM vaga WHERE idVaga = '$idVaga'");
                    $resulta = mysqli_fetch_array($query4);
                    $idEstac = $resulta['idEstac'];

                    $query5 = mysqli_query($conn, "SELECT valFixo, valAcresc FROM estacionamento WHERE idEstac = '$idEstac'");

                    if(mysqli_num_rows($query5) > 0){

                        $result2 = mysqli_fetch_array($query5);
                        $valFixo = $result2['valFixo'];
                        $valAcresc = $result2['valAcresc'];


                        $custo = $valFixo + ($valAcresc * $tempoEstac);

                        $sql1 = "UPDATE aloca SET hrSaida = current_timestamp(), valTotal = '$custo' WHERE idAloca = '$idAlocado';";

                        $sql2 = "UPDATE vaga SET condVaga = 0 WHERE idVaga='$idVaga';";

                        if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
                            $response["success"] = 1;
                        }
                                            
                    }
                }else{
                    $response["success"] = 0;
	                $response["error"] = "hora entrada nao encontrada";
                }
            }

        } else{
            $response["success"] = 0;
	        $response["error"] = "vaga nao encontrada";
        }
    endif;
} else {
	$response["success"] = 0;
	$response["error"] = "falha de autenticação";
}
echo json_encode($response);
