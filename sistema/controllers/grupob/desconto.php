<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/desconto.php';
$method = $_REQUEST['method'];

try {
    $controller = new \App\Controller\DescontoController();
    $controller->setAttributes($_REQUEST);
    $mensagem = $controller->$method();
} catch (\Throwable $th) {
    setcookie('insercaoDescontos', 'false', time()+2, '/');
    setcookie('mensangemInsercaoDescontos', $th->getMessage(), time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('insercaoDescontos', 'true', time()+2, '/');
setcookie('mensangemInsercaoDescontos', $mensagem, time()+2, '/');
header('Location: ' . $caminho);
die();