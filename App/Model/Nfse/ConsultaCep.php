<?php
namespace App\Model\Nfse;

use App\Model\ValueObject\Cep;
use App\Api\CurlNew;
use App\DAO\ApiDAO;

class ConsultaCep
{
    private $cep;

    public function __construct($cepEntrada)
    {
        $cep = new Cep($cepEntrada);
        $this->cep = $cep;
    }

    public function consulta()
    {
        $dao = new ApiDAO();
        $retorno = $dao->getDadosApi('nfse');

        $url = $retorno['url'] . '/cep/' . $this->cep->getCep();
        $token = $retorno['token'];        
        $header = ["x-api-key: $token"];
                
        $retorno = CurlNew::executaCurl($url, array(), $header);

        if ($retorno['respostaHttp'] != 200) {
            throw new \Exception("Falha ao consultar o CEP.", 1);            
        }

        return json_decode($retorno['dados'], 1);        
    }
}
