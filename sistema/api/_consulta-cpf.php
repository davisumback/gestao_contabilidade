<?php
require_once('../helper/curl.php');

$url = 'https://apigateway.serpro.gov.br/consulta-cpf-trial/1/cpf/'.$cpf;

$header = array('Authorization: Bearer 4e1a1858bdd584fdc077fb7d80f39283');

$retorno = curlExec($url, "", $header);

$resposta_api = "";

if($retorno['resposta_http'] == 200 || $retorno['resposta_http'] == 206){

    $resposta_api = true;
}else {

    $resposta_api = false;
}
