<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$arquivoRetorno = 'prospect.php';

try {
    $controller = new \App\Controller\ProspectController();
    $controller->setAttributes($_REQUEST);
    $metodo = $_REQUEST['method'];
    $mensagem = $controller->$metodo();
} catch (\Throwable $th) {
    setcookie("resultadoDadosProspect", "false", time()+2, '/');
    setcookie("mensagemDadosProspect", $th->getMessage(), time()+2, '/');
    header("Location: " . $pasta . '/' . $arquivoRetorno);
    die();
}

setcookie("resultadoDadosProspect", "true", time()+2, '/');
setcookie("mensagemDadosProspect", $mensagem, time()+2, '/');
header("Location: " . $pasta . '/' . $arquivoRetorno);
die();
