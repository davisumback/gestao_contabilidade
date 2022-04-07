<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$arquivoRetorno = $_REQUEST['arquivoRetorno'];

try {
    $controller = new \App\Controller\ContaBancariaController();
    $controller->setAttributes($_REQUEST);
    $metodo = $_REQUEST['method'];
    $mensagem = $controller->$metodo();
} catch (\Throwable $th) {
    setcookie("resultadoInsercaoConta", "false", time()+2, '/');
    setcookie("mensagemInsercaoConta", $th->getMessage(), time()+2, '/');
    header("Location: " . $pasta . '/' . $arquivoRetorno);
    die();
}

setcookie("resultadoInsercaoConta", "true", time()+2, '/');
setcookie("mensagemInsercaoConta", $mensagem, time()+2, '/');
header("Location: " . $pasta . '/' . $arquivoRetorno);
die();
