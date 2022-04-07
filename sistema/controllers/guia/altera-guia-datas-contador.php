<?php

use App\DAO\GuiaDataPadraoDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = $_SESSION['pasta'];
$caminho = '../../' . $pasta . '/index.php';

$dao = new GuiaDataPadraoDAO();

$dao->updateDataGuia('DAS', $_POST['das_vencimento']);
$dao->updateDataGuia('PIS', $_POST['pis_vencimento']);
$dao->updateDataGuia('COFINS', $_POST['cofins_vencimento']);
$dao->updateDataGuia('IRPJ', $_POST['irpj_vencimento']);
$dao->updateDataGuia('CSLL', $_POST['csll_vencimento']);
$dao->updateDataGuia('ISS', '01');

header('Location: ' . $caminho);
die();
