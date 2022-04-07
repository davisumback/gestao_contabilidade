<?php
namespace App\Model\Nfse;

use App\Model\ValueObject\Cnpj;
use App\DAO\ApiDAO;
use App\Api\CurlNew;

class ConsultaCnpj
{
    private $cnpj;

    public function __construct($cnpjEntrada)
    {
        $cnpj = new Cnpj($cnpjEntrada);
        $this->cnpj = $cnpj;
    }

    public function consulta()
    {
        $dao = new ApiDAO();
        $retorno = $dao->getDadosApi('nfse');

        $url = $retorno['url'] . '/cnpj/' . $this->cnpj->getCnpj();
        $token = $retorno['token'];        
        $header = ["x-api-key: $token"];
                
        $retorno = CurlNew::executaCurl($url, array(), $header);

        if ($retorno['respostaHttp'] != 200) {
            throw new \Exception("Falha ao consultar o CNPJ.", 1);            
        }

        return json_decode($retorno['dados'], 1);        
    }
}
