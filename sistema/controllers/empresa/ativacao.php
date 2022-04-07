<?php

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$arquivoRetorno = 'empresa-pesquisa.php';

try {
    $controller = new \App\Controller\AcessoController();
    $controller->setAttributes($_REQUEST);
    $metodo = $_REQUEST['method'];

    $mensagem = $controller->$metodo();

} catch (\Throwable $th) {
    setcookie("inativaEmpresa", "false", time() + 2, '/');
    setcookie("mensagemInativaEmpresa", $th->getMessage(), time() + 2, '/');
    header("Location: " . $pasta . '/' . $arquivoRetorno);
    die();
}

setcookie("inativaEmpresa", "true", time() + 2, '/');
setcookie("mensagemInativaEmpresa", $mensagem, time() + 2, '/');
header("Location: " . $pasta . '/' . $arquivoRetorno);
die();