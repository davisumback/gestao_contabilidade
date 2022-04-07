<?php
include __DIR__ . '/../../vendor/autoload.php';

session_start();
$empresasId = $_SESSION['empresasId'];

$dao = new \App\DAO\FaturamentoDAO();
$faturamento = $dao->getFaturamentosPdf($empresasId, 12);
$faturamento->gerarPdf($empresasId);