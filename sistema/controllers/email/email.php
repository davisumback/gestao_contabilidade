<?php
require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/reenvio-email.php';
$method = $_REQUEST['method'];

try {
   $controller = new \App\Controller\EmailController();
   $controller->setAttributes($_REQUEST);
   $mensagem = $controller->$method();
} catch (\Throwable $th) {
   setcookie('reenvioEmail', 'false', time() + 2, '/');
   setcookie('mensagemReenvioEmail', $th->getMessage(), time() + 2, '/');
   header('Location: ' . $caminho);
   die();
}

setcookie('reenvioEmail', 'true', time() + 2, '/');
setcookie('mensagemReenvioEmail', $mensagem, time() + 2, '/');
header('Location: ' . $caminho);
die();