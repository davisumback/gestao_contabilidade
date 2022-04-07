<?php
use App\DAO\ClienteDAO;
use App\Helper\Helpers;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

include __DIR__ . '/../../../vendor/autoload.php';

$cpfFormatado = Helpers::formataCpfBd($entrada);

$cpfArray = json_decode($cpfFormatado, true);

$clienteDAO = new ClienteDAO();
$retorno = $clienteDAO->getSocio($cpfArray['cpf']);

$retorno['cpf'] = Helpers::mask($retorno['cpf'],'###.###.###-##');

echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
