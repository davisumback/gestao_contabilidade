<?php

require_once('../../../vendor/autoload.php');

session_start();
$pasta = '../../' . $_SESSION['pasta'];

try {
    $dao = new \App\DAO\ContatoSiteDAO();
    $dao->avisaAtendimento($_POST);
} catch (\Throwable $th) {
    setcookie('resultadoContato', 'false', time()+2, '/');
    setcookie('mensagemContato', $th->getMessage(), time()+2, '/');
    header('Location: ' . $pasta . '/contato-site.php?contatos=naoAtendidos');
    die();
}



setcookie('resultadoContato', 'true', time()+2, '/');
setcookie('mensagemContato', 'Sucesso ao avisar o atendimento.', time()+2, '/');
header('Location: ' . $pasta . '/contato-site.php?contatos=naoAtendidos');
die();