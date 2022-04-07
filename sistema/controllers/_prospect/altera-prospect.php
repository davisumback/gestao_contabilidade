<?php

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$caminho = '../../' . $_SESSION['pasta'] . '/prospect.php';

$dao = new \App\DAO\ProspectDAO();
$retorno = $dao->updateProspect($_POST);

if ($retorno == false) {
    setcookie('resultadoDadosProspect', 'false', time()+2, '/');
    setcookie('mensagemDadosProspect', 'Falha ao editar o prospect!', time()+2, '/');
    header("Location: " . $caminho);
    die();
}

setcookie('resultadoDadosProspect', 'true', time()+2, '/');
setcookie('mensagemDadosProspect', 'Sucesso ao editar o prospect!', time()+2, '/');
header("Location: " . $caminho);
die();