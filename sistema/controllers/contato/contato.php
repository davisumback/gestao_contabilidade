<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/contato.php';
$method = $_REQUEST['method'];

try {
    $controller = new \App\Controller\ContatoController();
    $controller->setAttributes($_REQUEST);
    $mensagem = $controller->$method();
} catch (\Throwable $th) {
    setcookie('insercaoContato', 'false', time() + 2, '/');
    setcookie('mensangemInsercaoContato', $th->getMessage(), time() + 2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('insercaoContato', 'true', time() + 2, '/');
setcookie('mensangemInsercaoContato', $mensagem, time() + 2, '/');
header('Location: ' . $caminho);
die();