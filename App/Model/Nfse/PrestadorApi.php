<?php
namespace App\Model\Nfse;

use App\Model\Nfse\Prestador;
use App\Api\CurlNew;

class PrestadorApi
{
    const METHOD = '/nfse/prestador';

    public function envia(Prestador $prestador)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . self::METHOD;
        $token = $dados['token'];

        $post = json_encode($prestador);
        
        $header = [
            "x-api-key: $token",
            "Content-Length: " . strlen($post),
            "Content-Type: application/json; charset=utf-8"
        ];

        return CurlNew::executaCurl($url, $post, $header);
    }

    public function consulta($cnpj)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . self::METHOD . '/' . $cnpj;
        $token = $dados['token'];

        $header = [
            "x-api-key: $token"
        ];

        return CurlNew::executaCurl($url, null, $header);
    }
}