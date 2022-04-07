<?php
use App\DAO\ClienteDAO;

include __DIR__ . '/../../vendor/autoload.php';

$dao = new ClienteDAO();
$clientes = $dao->exportDirecionamentoIR();

header("Content-Disposition: attachment; filename=\"direcionamento-ir.xls\"");
header("Content-Type: application/vnd.ms-excel;");
header("Pragma: no-cache");
header("Expires: 0");

$out = fopen("php://output", 'w');
foreach ($clientes as $data)
{
    $data = array_map("utf8_decode", $data);
    fputcsv($out, $data,"\t");
}
fclose($out);
