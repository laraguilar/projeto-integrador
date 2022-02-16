<?php
// sessao
require_once 'php_actions/sessaoLog.php';

//header
include_once 'includes/headerLog.php';

$msg = false;
if (isset($_FILES['arquivo'])) {
    $arquivo = $_FILES['arquivo']['name'];
    $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

    $novo_nome = md5(time()) . "." . $extensao;

    $diretorio = "imagem/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
    
    $sql = "SELECT idImg, nome FROM imagem WHERE idEmpresa = '$id'";
    $query = mysqli_query($conn, $sql);
    $idImg = mysqli_fetch_assoc($query);

    if(!empty($idImg)){
        $sql_code = "UPDATE imagem SET nome = '$novo_nome', dataImg = NOW() WHERE idEmpresa = '$id';";
        if (mysqli_query($conn, $sql_code)):
            $msg = "Arquivo enviado com sucesso!";
        else:
            $msg = "Falha ao enviar arquivo!";
        endif;
    } else{
        $query2 = mysqli_query($conn, "INSERT INTO imagem (nome, dataImg, idEmpresa) VALUES ('$novo_nome', now(), '$id')");
        $query3 = mysqli_query($conn, "SELECT nome from imagem WHERE idEmpresa = '$id'");
        $nomImg = mysqli_fetch_array($query3);
        $nomImg = $nomImg['nome'];
        $arquivo = $nomImg;
    }
}



$sql3 = "SELECT * FROM imagem where idEmpresa = '$id'";
$mostrar = mysqli_query($conn, $sql3);
//$qtd_arquivos = mysqli_num_rows($mostrar);
//$msg_sem = ($qtd_arquivos <= 0) ? "NÃO HÁ ARQUIVOS NO SISTEMA!" : "";

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Estacioney</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" type="imagex/png" href="imagem/logo_estacioney50px.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div class="container" style="margin: auto; width: 60%;">
        <div class="row">
            <div class="col center-align">
                <div class="row s12 m6 center-align">
                    <div class="col s12 z-depth-1">
                        <h3 class="center">Dados da Empresa</h3>
                        <br>
                        <?php
                        while($imgSistema = mysqli_fetch_array($mostrar)){
                            if($imgSistema == null){
                                echo "<img class='circle responsive-img' style='width: 20%; height:20%' src='imagem/img_perf.png'>";
                            }
                            else{
                                $arquivo = $imgSistema['nome'];
                                echo "<img class='center-align' style='width: 20%; height:20%;' src='imagem/".$arquivo."'>";
                            }
                        }
                        ?>
                        
                        
                        <div class="row">
                        <div class="col s4">

                        </div>
                        <div class="col s4">
                        <form action="empresa.php" method="POST" enctype="multipart/form-data"><br>
                            <div class="row file-field input-field center-align">
                                <div class="col s4 btn indigo darken-2 center-align" style="width: auto;">
                                    <span><i class="material-icons">file_upload</i></span>
                                    <input type="file" name="arquivo">
                                </div>
                                <div class="col s4 right-align">
                                    <button type="submit" name="enviarImg" class="waves-effect waves-light btn indigo darken-2">Atualizar imagem</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="col s4">
                        </div>
                        </div>

                        <div class="row center">

                        
                            <div class="col s12 left-align">
                                
                                <!-- A partir de agora todas as cols são uma linha do "histórico"-->
                                <div class="row">
                                    <div class="divider"></div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="row">
                                            <!-- Cria duas colunas para os dados e os botoes ficarem na mesma linha e em sentidos opostos -->
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">Nome da Empresa</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p><?php echo $dados['nomEmpresa']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">E-mail</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p><?php echo $dados['email']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">CPF/CNPJ</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p><?php echo $dados['dscCpfCnpj']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <!-- LINHA -->
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="section">
                                                <div class="col s4">
                                                    <p style="font-weight: bold;">Telefone</p>
                                                </div>
                                                <div class="col s8 pull-s1 ">
                                                    <p><?php echo $dados['telefone']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <!-- LINHA -->
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="section">
                                                    <div class="col s6">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        include_once 'includes/footer.php';?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="main.js"></script>
</body>                 
</html>
