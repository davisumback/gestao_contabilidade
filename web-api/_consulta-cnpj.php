<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

require_once '../vendor/autoload.php';

use App\Api\Saida\Cnpj;

$cnpjArray = json_decode($entrada, true);

$retorno = Cnpj::consultaCnpj($cnpjArray['cnpj']);

echo $retorno['dados'];
