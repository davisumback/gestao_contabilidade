<?php

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/empresa-funcionario.php';
$method = $_REQUEST['method'];

try {
    $controller = new \App\Controller\FuncionarioController();
    $controller->setAttributes($_REQUEST);
    $mensagem = $controller->$method();
} catch (\Throwable $th) {
    setcookie('insercaoFuncionario', 'false', time()+2, '/');
    setcookie('mensagemInsercaoFuncionario', $th->getMessage(), time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('insercaoFuncionario', 'true', time()+2, '/');
setcookie('mensagemInsercaoFuncionario', $mensagem, time()+2, '/');
header('Location: ' . $caminho);
die();