<?php
require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$arquivoRetorno = 'envio-documentos.php';

try {
    $controller = new \App\Controller\UploadArquivoController();
    $controller->setAttributes($_REQUEST, $_FILES);
    $metodo = $_REQUEST['method'];
    $mensagem = $controller->$metodo();
} catch (\Throwable $th) {
    setcookie("resultadoUploadArquivo", "false", time()+2, '/');
    setcookie("mensagemUploadArquivo", $th->getMessage(), time()+2, '/');
    header("Location: " . $pasta . '/' . $arquivoRetorno);
    die();
}

setcookie("resultadoUploadArquivo", "true", time()+2, '/');
setcookie("mensagemUploadArquivo", $mensagem, time()+2, '/');
header("Location: " . $pasta . '/' . $arquivoRetorno);
die();