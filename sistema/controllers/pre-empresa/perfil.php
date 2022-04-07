<?php
use App\DAO\PreEmpresaDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$empresaDAO = new PreEmpresaDAO();
$retorno = $empresaDAO->pesquisaPreEmpresaCompleta($_POST['empresas_id']);

if ($retorno) {
    $_SESSION['PreEmpresaId'] = $retorno[0]['id'];
    $_SESSION['PreEmpresainfo'] = json_encode($retorno);
    header("Location: " . $pasta . "/pre-empresa-dados.php");
    die();
}

setcookie("resultadoInfosEmpresa", "false", time()+2, '/');
setcookie("mensagemInfosEmpresa", "Falha ao acessar perfil da empresa selecionada.", time()+2, '/');
header("Location: " . $pasta . "/pre-empresa-all.php");
die();
