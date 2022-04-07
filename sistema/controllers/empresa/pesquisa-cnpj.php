<?php

use App\Api\Saida\Cnpj;
use App\Helper\Helpers;
use App\DAO\EmpresaDAO;
use App\DAO\ApiDAO;

require_once '../../../vendor/autoload.php';

$cnpj = $_POST['cnpj'];
$pasta = '../../' . $_POST['pasta'];

$dao = new EmpresaDAO();
$retorno = $dao->isEmpresaCadastrada(Helpers::formataCnpjBd($cnpj));

if($retorno != null){
    setcookie('resultado_pesquisa_cnpj', 'false', time()+2, '/');
    setcookie('mensagem_pesquisa_cnpj', 'Cnpj já está cadastrado em nosso sistema.', time()+2, '/');
    header("Location: " . $pasta . '/form-cnpj.php');
    die();
}

$apiDao = new ApiDAO();
$api = $apiDao->getApi('cnpj');
$token = ($api['ativo'] == 1) ? $api['token'] : $api['token_teste'];

$retorno = Cnpj::consultaCnpj($cnpj, $api['url'], $token);

// echo '<pre>';
// print_r($retorno);
// echo '</pre>';
// die();

$resultaPesquisa = json_decode($retorno['dados'],true);

if($api['ativo'] == 1) {
    $apiDao->setQuantidadeRequisicoesRestantes('cnpj', $resultaPesquisa['saldo']);
}

if(array_key_exists('erroCodigo', $resultaPesquisa)) {
    setcookie('resultado_pesquisa_cnpj', 'false', time()+2, '/');
    setcookie('mensagem_pesquisa_cnpj', $resultaPesquisa['erro'], time()+2, '/');
    header("Location: " . $pasta . '/form-cnpj.php');
    die();
}else{
    session_start();
    $_SESSION['api_dados_empresa'] = $retorno['dados'];
    header("Location: " . $pasta . '/form-empresa.php');
    die();
}
