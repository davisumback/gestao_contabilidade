<?php
require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$arquivoRetorno = 'locais-trabalho.php';
$method = $_REQUEST['method'];

echo '<pre>';
print_r($_POST);
echo '</pre>';
die();

// try {
//     $controller = new \App\Controller\LocalTrabalho();
//     $controller->setAttributes($_REQUEST);
//     $metodo = $_REQUEST['method'];
//     $mensagem = $controller->$metodo();
// } catch (\Throwable $th) {
//     setcookie("resultadoLocalTrabalho", "false", time()+2, '/');
//     setcookie("mensagemLocalTrabalho", $th->getMessage(), time()+2, '/');
//     header("Location: " . $pasta . '/' . $arquivoRetorno);
//     die();
// }

setcookie("resultadoLocalTrabalho", "true", time()+2, '/');
setcookie("mensagemLocalTrabalho", $mensagem, time()+2, '/');
header("Location: " . $pasta . '/' . $arquivoRetorno);
die();
