<?php

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$caminho = '../../' . $_SESSION['pasta'] . '/prospect.php';

try {
    $dao = new \App\DAO\ProspectDAO();
    $retorno = $dao->deletaProspect($_POST['prospectId']);
} catch (\Throwable $th) {
    setcookie('resultadoDadosProspect', 'false', time()+2, '/');
    setcookie('mensagemDadosProspect', $th->getMessage(), time()+2, '/');
    header("Location: " . $caminho);
    die();
}

setcookie('resultadoDadosProspect', 'true', time()+2, '/');
setcookie('mensagemDadosProspect', 'Sucesso ao deletar o prospect!', time()+2, '/');
header("Location: " . $caminho);
die();
