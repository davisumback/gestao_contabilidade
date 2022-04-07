<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/ies.php';
$method = $_REQUEST['method'];

try {
    $controller = new \App\Controller\IesController();
    $controller->setAttributes($_REQUEST);
    $mensagem = $controller->$method();
} catch (\Throwable $th) {
    setcookie('insercaoIes', 'false', time()+2, '/');
    setcookie('mensangemInsercaoIes', $th->getMessage(), time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('insercaoIes', 'true', time()+2, '/');
setcookie('mensangemInsercaoIes', $mensagem, time()+2, '/');
header('Location: ' . $caminho);
die();