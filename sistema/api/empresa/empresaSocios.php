<?php
use App\DAO\EmpresaDAO;

header('Access-Control-Allow-Headers: Content-Type');

$entrada = file_get_contents('php://input');

include __DIR__ . '/../../../vendor/autoload.php';

$resultado = json_decode($entrada, true);

$dao = new EmpresaDAO();
$socios = $dao->getSocios($resultado['empresasId']);

echo json_encode($socios, JSON_UNESCAPED_UNICODE);