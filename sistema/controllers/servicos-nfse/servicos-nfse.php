<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$arquivoRetorno = 'servico-nfse.php';

try {
    $controller = new \App\Controller\ServicosNFSeController();
    $controller->setAttributes($_REQUEST);
    $metodo = $_REQUEST['method'];
    $mensagem = $controller->$metodo();
} catch (\Throwable $th) {
    setcookie('insercaoServicos', 'false', time()+2, '/');
    setcookie('mensangemInsercaoServicos', $th->getMessage(), time()+2, '/');
    header("Location: " . $pasta . '/' . $arquivoRetorno);
    die();
}

setcookie('insercaoServicos', 'true', time()+2, '/');
setcookie('mensangemInsercaoServicos', $mensagem, time()+2, '/');
header("Location: " . $pasta . '/' . $arquivoRetorno);
die();