<?php 
// Sessão
session_start();
// Conexão DB
include_once './conexao.php';

$idEstac = $_SESSION['dadosEstac']['idEstac'];

// verifica se o botao foi clicado
if(isset($_POST['btnCadCarro'])):
    
    // atribui os valores do formulario
    $nomCliente = mysqli_escape_string($conn, $_POST['nomCliente']);
    $cpfCliente = mysqli_escape_string($conn, $_POST['cpfCliente']);
    $placaCarro = mysqli_escape_string($conn, $_POST['placaCarro']);
    $vagaCarro = mysqli_escape_string($conn, $_POST['select']); // não é id do BD

    
    if(!empty($nomCliente) && !empty($cpfCliente) && !empty($placaCarro) && !empty($vagaCarro)):

        // Array de erros
        $erros = array();
        
        //Sanitize e Validate
        $nomCliente = filter_input(INPUT_POST, 'nomCliente', FILTER_SANITIZE_SPECIAL_CHARS);

        $cpfCliente = filter_input(INPUT_POST, 'cpfCliente', FILTER_SANITIZE_SPECIAL_CHARS);

        $placaCarro = filter_input(INPUT_POST, 'placaCarro', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $query2 = mysqli_query($conn, "SELECT * FROM vaga where idEstac = '$idEstac'");
        $vagas = mysqli_fetch_array($query2);

        $vag = $_SESSION['vaga'];

        

        //verifica se as vagas sao do estacionamento
        if(in_array($vagaCarro, $vag)){
            $arr = array_keys($vag, $vagaCarro);
            $idVagaBD = $arr[0];
            // verifica se a vaga esta desocupada
            $vagaVazia = "SELECT condVaga FROM vaga WHERE idVaga = $idVagaBD";
            $query = mysqli_query($conn, $vagaVazia);
            $result = mysqli_fetch_assoc($query);
        if($result['condVaga']):
            $erros[] = "vaga ocupada";
        endif;
        }

        // exibindo mensagens de erro
        if (!empty($erros)) :
            header('Location: ../entrada.php');
        else :
            // código SQL para inserir os dados
            
            // faz a inserção dos dados
            $sql = "INSERT INTO aloca (idVaga, hrEntrada, dscPlaca, nomCliente, cpfCliente) VALUES ('$idVagaBD', CURRENT_TIMESTAMP, '$placaCarro', '$nomCliente', '$cpfCliente');";
            $sql2 = "UPDATE vaga SET condVaga = 1 WHERE idVaga = '$idVagaBD' and idEstac = '$idEstac';";

            


            if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)):
                header('Location: ../home.php'); // aqui deve ir para a tela home
                //$_SESSION['mensagem'] = "";
            else:
                header('Location: ../entrada.php');
                //$_SESSION['mensagem'] = "Erro ao cadastrar cliente.";
            endif;
        endif;
    else:
        header('Location: ../entrada.php');
        $_SESSION['mensagem'] = "Preencha todos os campos";
    endif;

endif;
