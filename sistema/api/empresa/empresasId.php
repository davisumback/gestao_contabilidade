<?php
use App\DAO\EmpresaDAO;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

include __DIR__ . '/../../../vendor/autoload.php';

$dao = new EmpresaDAO();
$retorno = $dao->getEmpresasId();

echo json_encode($retorno);