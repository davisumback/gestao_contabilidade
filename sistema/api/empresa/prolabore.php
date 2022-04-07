<?php
use App\DAO\EmpresaDAO;
use App\Helper\Helpers;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

include __DIR__ . '/../../../vendor/autoload.php';

$liberacao = json_decode($entrada, true);

$empresaDao = new EmpresaDAO();
$retorno = $empresaDao->getProlabore($liberacao['empresasId'], $liberacao['competencia']);

// print_r($liberacao);

echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
