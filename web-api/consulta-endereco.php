<?php

header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
//header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

require_once '../vendor/autoload.php';

use App\Api\Saida\Cep;

$cepArray = json_decode($entrada, true);

$retorno = Cep::consultaCep($cepArray['cep']);

echo $retorno['dados'];
