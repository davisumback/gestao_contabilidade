<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$arquivoRetorno = $_REQUEST['arquivoRetorno'];

try {
    $controller = new \App\Controller\DomesticaController();
    $controller->setAttributes($_REQUEST);
    $metodo = $_REQUEST['method'];
    $mensagem = $controller->$metodo();
} catch (\Throwable $th) {
    setcookie("resultadoInsercaoDomestica", "false", time()+2, '/');
    setcookie("mensagemInsercaoDomestica", $th->getMessage(), time()+2, '/');
    header("Location: " . $pasta . '/' . $arquivoRetorno);
    die();
}

setcookie("resultadoInsercaoDomestica", "true", time()+2, '/');
setcookie("mensagemInsercaoDomestica", $mensagem, time()+2, '/');
header("Location: " . $pasta . '/' . $arquivoRetorno);
die();
