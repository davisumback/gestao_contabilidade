<?php
include __DIR__ . '/../../vendor/autoload.php';

session_start();
$empresasId = $_SESSION['viewIdEmpresa'];

$dao = new \App\DAO\FaturamentoDAO();
$faturamento = $dao->getFaturamentosPdf($empresasId, 12);
$faturamento->gerarPdf($empresasId);