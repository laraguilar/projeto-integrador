<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// connecting to db

include_once "conexao.php";
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['newEmail']) && (isset($_POST['newPassword'])) && (isset($_POST['newCpfCnpj'])) && (isset($_POST['newNomEmpresa'])) && (isset($_POST['newTelefone']))) {
 
	$newEmail = trim($_POST['newEmail']);
	$newPassword = trim($_POST['newPassword']);
	$newNomEmpresa = ($_POST['newNomEmpresa']);
	$newCpfCnpj = trim($_POST['newCpfCnpj']);
	$newTelefone = trim($_POST['newTelefone']);
	
	$usuario_existe = mysqli_query($conn, "SELECT email FROM empresa WHERE email='$newEmail'");
	// check for empty result
	if (mysqli_num_rows($usuario_existe) > 0) {
		$response["success"] = 0;
		$response["error"] = "usuario ja cadastrado";
	}
	else {
		$senhaCript = password_hash($newPassword, PASSWORD_DEFAULT);
		// mysql inserting a new row
		$result = mysqli_query($conn, "INSERT INTO empresa(nomEmpresa, dscCpfCnpj,email, telefone, senha) VALUES('$newNomEmpresa', '$newCpfCnpj', '$newEmail', '$newTelefone','$senhaCript')");
	 
		if ($result) {
			$response["success"] = 1;
		}
		else {
			$response["success"] = 0;
			$response["error"] = "Error".mysqli_connect_error($conn);
		}
	}
}
else {
    $response["success"] = 0;
	$response["error"] = "faltam parametros";
}

mysqli_close($conn);
echo json_encode($response);
?>