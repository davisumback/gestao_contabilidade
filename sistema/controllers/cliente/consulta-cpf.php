<?php
use App\DAO\ClienteDAO;
use App\Helper\Helpers;
use App\Api\Saida\Cpf;
use App\DAO\ApiDAO;

include __DIR__ . '/../../../vendor/autoload.php';

$entrada = file_get_contents('php://input');

$cpfArray = json_decode($entrada, true);

$cpf = Helpers::formataCpfBd($cpfArray['cpf']);

$apiDao = new ApiDAO();
$api = $apiDao->getApi('cpf');
$token = ($api['ativo'] == 1) ? $api['token'] : $api['token_teste'];

$respostaApi = Cpf::consultaCpf($cpf ,$api['url'], $token);
$arrayRepostaApi = json_decode($respostaApi['dados'], true);

if($api['ativo'] == 1) {
    $apiDao->setQuantidadeRequisicoesRestantes('cpf', $arrayRepostaApi['saldo']);
}

echo $respostaApi['dados'];
