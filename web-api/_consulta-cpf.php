<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

require_once '../vendor/autoload.php';

use App\Api\Saida\Cpf;

$cpfArray = json_decode($entrada, true);

$retorno = Cpf::consultaCpf($cpfArray['cpf']);

echo $retorno['dados'];
