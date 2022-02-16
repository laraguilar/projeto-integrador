<?php


function getAddress()
{
    if (isset($_POST['cep'])) {
        $cep = $_POST['cep'];

        $cep = filterCep($cep);

        if (isCep($cep)) {
            $endereco = getAddressViaCep($cep);
            if (property_exists($endereco, 'erro')) {
                $endereco = addressEmpty();
                $endereco->cep = 'CEP inválido!';
            }
        } else {
        }
    } else {
        $endereco = addressEmpty();
    }

    return $endereco;
}

function addressEmpty()
{
    return  (object)[
        'cep' => '',
        'logradouro' => '',
        'bairro' => '',
        'localidade' => '',
        'uf' => ''

    ];
}

function filterCep(String $cep): String
{
    return preg_replace('/[^0-9]/', '', $cep);
}

function isCEP(String $cep): bool
{
    return preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep);
}

function getAddressViaCep(String $cep)
{
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    return json_decode(file_get_contents($url));
}
