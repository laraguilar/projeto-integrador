<?php
//header
include_once 'includes/headerLog.php';
// sessao
require_once 'php_actions/sessaoLog.php';
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

    <script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                document.getElementById('ibge').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>
</head>

<body>
    <div class="container" style="margin: auto; width: 60%;">
        <div class="row">
            <form action="php_actions/cadEstacDB.php" method="POST" class="col s6" style="margin-left: 50%; margin-right:50%; transform: translate(-50%, 0%);">
                <h3 style="text-align: center;">Cadastro do Estacionamento</h3>
                <div class="row center-align">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="nomEstac" type="text" id="nomeEstac" class="validate" autofocus>
                                <label for="text">Nome do Estacionamento</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="qtdVagas" type="number" step="1" min="1" id="qtdVagas" class="validate">
                                <label for="text">Quantidade de vagas</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="valFixo" type="number" min="0.01" step="0.01" id="valFixo">
                                <label for="text">Valor Fixo</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="valAcresc" type="number" min="0.00" step="0.01" id="valAcresc">
                                <label for="text">Acréscimo/hora</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);">
                                <label for="text">CEP</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="rua" type="text" id="rua" size="60" class="validate">
                                <label for="text">Rua</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="num" type="number" id="num" class="validate">
                                <label for="text">Número</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="bairro" type="text" id="bairro" size="40" class="validate">
                                <label for="text">Bairro</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="cidade" type="text" id="cidade" class="validate">
                                <label for="text">Cidade</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="uf" type="text" id="uf" size="2" class="validate">
                                <label for="text">Estado</label>
                            </div>
                            <div class="input-field col s12">
                                <label type="hidden" class="white-text">IBGE:
                                <input name="ibge" type="hidden" id="ibge" size="8" /></label><br />
                            </div>
                            <button type="submit" name="btnCadEstac" class="waves-effect waves-light btn indigo darken-2">Cadastrar</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="main.js"></script>
    <?php 
        include_once 'includes/footer.php';?>
</body>

</html>