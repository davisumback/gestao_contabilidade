<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$arquivoRetorno = 'acesso.php';

try {
    $controller = new \App\Controller\AcessoController();
    $controller->setAttributes($_REQUEST);
    $metodo = $_REQUEST['method'];

    $mensagem = $controller->$metodo();

} catch (\Throwable $th) {
    setcookie("resultadoDadosFaturamendo", "false", time()+2, '/');
    setcookie("mensagemDadosFaturamendo", $th->getMessage(), time()+2, '/');
    header("Location: " . $pasta . '/' . $arquivoRetorno);
    die();
}

setcookie("resultadoDadosFaturamendo", "true", time()+2, '/');
setcookie("mensagemDadosFaturamendo", $mensagem, time()+2, '/');
header("Location: " . $pasta . '/' . $arquivoRetorno);
die();
