<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

require_once '../vendor/autoload.php';
require_once '../banco/conecta-medb.php';

use App\DAO\ClienteDAO;
use App\Helper\Helpers;

$cpfFormatado = Helpers::formataCpfBd($entrada);

$cpfArray = json_decode($cpfFormatado, true);

$clienteDAO = new ClienteDAO($conexao);
$retorno = $clienteDAO->getSocio($cpfArray['cpf']);

$retorno['cpf'] = Helpers::mask($retorno['cpf'],'###.###.###-##');

echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
