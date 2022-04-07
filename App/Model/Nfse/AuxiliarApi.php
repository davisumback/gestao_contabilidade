<?php
namespace App\Model\Nfse;

use App\Model\Nfse\Prestador;
use App\Api\CurlNew;

class AuxiliarApi
{
    public function consultaCep($cep)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . '/cep/' . $cep;
        $token = $dados['token'];

        $header = [
            "x-api-key: $token"
        ];

        return CurlNew::executaCurl($url, null, $header);
    }

    public function consultaCnpj($cnpj)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . '/cnpj/' . $cnpj;
        $token = $dados['token'];

        $header = [
            "x-api-key: $token"
        ];

        return CurlNew::executaCurl($url, null, $header);
    }  
}