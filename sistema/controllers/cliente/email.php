<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/cliente-email.php';
$method = $_REQUEST['method'];

try {
    $controller = new \App\Controller\ClienteController();
    $controller->setAttributes($_REQUEST);
    $mensagem = $controller->$method();
} catch (\Throwable $th) {
    setcookie('inserecaoEmail', 'false', time()+2, '/');
    setcookie('mensagemInsercaoEmail', $th->getMessage(), time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('inserecaoEmail', 'true', time()+2, '/');
setcookie('mensagemInsercaoEmail', $mensagem, time()+2, '/');
header('Location: ' . $caminho);
die();