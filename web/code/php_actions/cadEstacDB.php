<?php
// Conexão DB
require_once 'conexao.php';
require_once 'sessaoLog.php';

// Array de erros
$erros = array();

// verifica se o botao foi clicado
if (isset($_POST['btnCadEstac'])) :
// atribui os valores do formulario
    $nomEstac = mysqli_escape_string($conn, $_POST['nomEstac']);
    $qtdVagas = mysqli_escape_string($conn, $_POST['qtdVagas']);
    $valFixo = $_POST['valFixo'];
    $valAcresc = $_POST['valAcresc'];
    $cep = mysqli_escape_string($conn, $_POST['cep']);
    $rua = mysqli_escape_string($conn, $_POST['rua']);
    $bairro = mysqli_escape_string($conn, $_POST['bairro']);
    $cidade = mysqli_escape_string($conn, $_POST['cidade']);
    $estado = mysqli_escape_string($conn, $_POST['uf']);
    $num = mysqli_escape_string($conn, $_POST['num']);

    if(!empty($nomEstac) && !empty($qtdVagas) && !empty($valFixo) && !empty($valAcresc) && !empty($cep) && !empty($rua) && !empty($bairro) && !empty($cidade) && !empty($estado) && !empty($num)):
        //Sanitize e Validate
        $nomEstac = filter_input(INPUT_POST, 'nomEstac', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $estac = "SELECT idEstac FROM estacionamento WHERE idEmpresa = $id and nomEstac = '$nomEstac';";
        $query = mysqli_query($conn, $estac);
        if((mysqli_num_rows($query))>0):
            $erros[] = "Este nome já está sendo utilizado.";
        endif;

        $qtdVagas = filter_input(INPUT_POST, 'qtdVagas', FILTER_SANITIZE_NUMBER_INT);
        if (!filter_var($qtdVagas, FILTER_VALIDATE_INT)) :
            $erros[] = "Quantidade de vagas precisa ser inteiro";
        endif;

        if (!filter_var($valFixo, FILTER_VALIDATE_FLOAT)) :
            $erros[] = "Valor fixo deve ser float";
        endif;

        if (!filter_var($valAcresc, FILTER_VALIDATE_FLOAT)):
            $erros[] = "Acréscimo/hora deve ser float";
        endif;

        $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);

        $num = filter_input(INPUT_POST, 'num', FILTER_SANITIZE_NUMBER_INT);
        if (!filter_var($num, FILTER_VALIDATE_INT)) :
            $erros[] = "Número deve conter apenas numeros";
        endif;

        $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS);
        $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
        $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS);


        // exibindo mensagens de erro
        if (!empty($erros)) :
            header('Location: ../cadEstac.php');
        else :
            // código SQL para inserir os dados
            // codigo de cadastro do estacionamento
            $sql = "INSERT INTO estacionamento (nomEstac, qtdVagas, valFixo, valAcresc, idEmpresa) VALUES ('$nomEstac', '$qtdVagas', '$valFixo', '$valAcresc', '$id');";
            
            // verifica se o insert deu certo
            if(mysqli_query($conn, $sql)):
                // pega o id do estacionamento cadastrado
                $sqlIdEmp = "SELECT idEstac, qtdVagas from Estacionamento WHERE idEmpresa = '$id' and nomEstac = '$nomEstac';";
                $query = mysqli_query($conn, $sqlIdEmp);
                $resultQuery = mysqli_fetch_array($query);
                $idEstac = $resultQuery['idEstac'];

                $qtdVaga = $resultQuery['qtdVagas'];

                // cadastro do endereço
                $sqlCadEnd = "INSERT INTO endereco (dscLogradouro, numero, cep, bairro, cidade, estado, idEstac) VALUES ('$rua', '$num', '$cep', '$bairro', '$cidade', '$estado', '$idEstac')";

                // verifica se o cadastro foi realizado com sucesso
                if(mysqli_query($conn, $sqlCadEnd)):
                    
                    for($i=0; $i<$qtdVaga; $i++){
                        $sql2 = "INSERT INTO vaga (condVaga, idEstac) VALUES (DEFAULT, '$idEstac')";
                        mysqli_query($conn, $sql2);
                    }

                    $query4 = mysqli_query($conn, "SELECT * FROM vaga WHERE idEstac = '$idEstac'");

                    if(mysqli_num_rows($query4) > 0):

                        $sql3 = "SELECT * FROM estacionamento WHERE idEmpresa = '$id'";
                        $query3 = mysqli_query($conn, $sql3);

                        $dadosEstac = mysqli_fetch_array($query3);
                        $_SESSION['dadosEstac'] = $dadosEstac;


                        header('Location: ../listEstacs.php');
                    else:
                        header('Location: ../sobrenos.php');                    
                        $erros[] = "Erro ao inserir vagas";
                    endif;
                    
                else:
                    header('Location: ../cadEstac.php');
                    $erros[] = "Erro ao cadastrar endereço";
                    //$sql = "DELETE FROM estacionamento WHERE idEmpresa = $id;"; -> apagaria a empresa, caso nao tenha um endereço. Porem o endereco nao é algo que no momento deixa nosso codigo desfuncional, portanto nao é extremamente necessario que isso ocorra. A correcao de erro sera feita no listEstacs
                endif;
            else:
                header('Location: ../cadEstac.php');
                $erros[] = "Erro ao cadastrar estacionamento";
            endif;
        endif;
    else:
        header('Location: ../cadEstac.php');
        $erros[] = "Preencha todos os campos";
    endif;
endif;