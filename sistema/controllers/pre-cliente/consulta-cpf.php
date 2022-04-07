<?php
use App\DAO\ClienteDAO;
use App\Helper\Helpers;
use App\Api\Saida\Cpf;
use App\DAO\ApiDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$caminho = '../../' . $_SESSION['pasta'];

$cpf = Helpers::formataCpfBd($_POST['cpf']);
$dao = new ClienteDAO();
$retorno = $dao->isCpfCadastrado($cpf);

if($retorno != null) {
    setcookie('consulta_cpf', 'false', time()+2, '/');
    setcookie('resposta_cpf', 'Este CPF já possui cadastro.', time()+2, '/');
    header('Location: ' . $caminho . '/form-cpf.php');
    die();
}

$apiDao = new ApiDAO();
$api = $apiDao->getApi('cpf');
$token = ($api['ativo'] == 1) ? $api['token'] : $api['token_teste'];

$respostaApi = Cpf::consultaCpf($cpf ,$api['url'], $token);
$arrayRepostaApi = json_decode($respostaApi['dados'], true);

if($api['ativo'] == 1) {
    $apiDao->setQuantidadeRequisicoesRestantes('cpf', $arrayRepostaApi['saldo']);
}

if($arrayRepostaApi['status'] == 0) {
    setcookie('consulta_cpf', 'false', time()+2, '/');
    setcookie("resposta_cpf", $arrayRepostaApi['erro'], time()+2, '/');
    header('Location: ' . $caminho . '/form-cpf.php');
    die();
}

$_SESSION['cliente_pre_cadastro'] = $respostaApi['dados'];
header('Location: ' . $caminho . '/form-pre-cadastro.php');
die();
