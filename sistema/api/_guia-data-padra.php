<?php

use App\DAO\GuiaDataPadraoDAO;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

include __DIR__ . '/../../vendor/autoload.php';

$dao = new GuiaDataPadraoDAO();
$retorno = $dao->getDataPadraoGuia('DAS');

print_r($retorno);


//
// $cepArray = json_decode($entrada, true);
//
// $retorno = Cep::consultaCep($cepArray['cep']);
//
// echo $retorno['dados'];
