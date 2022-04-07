<?php
require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/' . $_REQUEST['arquivoRetorno']; 
$method = $_REQUEST['method'];

try {
    $controller = new \App\Controller\EmpresaController();
-    $controller->setAttributes($_REQUEST);
    $mensagem = $controller->$method();
} catch (\Throwable $th) {
    setcookie('insercaoEmpresaController', 'false', time()+2, '/');
    setcookie('mensagemEmpresaController', $th->getMessage(), time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('insercaoEmpresaController', 'true', time()+2, '/');
setcookie('mensagemEmpresaController', $mensagem, time()+2, '/');
header('Location: ' . $caminho);
die();