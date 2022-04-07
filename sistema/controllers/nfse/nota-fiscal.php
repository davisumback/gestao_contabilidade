<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
// $caminho = $pasta . '/nota-fiscal.php';
$caminho = $pasta . '/' . $_REQUEST['caminhoRetorno'];
$method = $_REQUEST['method'];

try {
    $controller = new \App\Controller\Nfse\NotaFiscalController();
    $controller->setAttributes($_REQUEST);
    $mensagem = $controller->$method();
} catch (\Throwable $th) {
    setcookie('emissaoNotaFiscal', 'false', time()+2, '/');
    setcookie('mensagemNotaFiscal', 'Erro! ' . $th->getMessage(), time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('emissaoNotaFiscal', 'true', time()+2, '/');
setcookie('mensagemNotaFiscal', $mensagem, time()+2, '/');
header('Location: ' . $caminho);
die();