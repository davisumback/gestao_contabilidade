<?php

use App\DAO\EmpresaDAO;

require_once '../../../vendor/autoload.php';

$empresaDAO = new EmpresaDAO();
$pasta = '../../' . $_POST['pasta'];

if ($_POST['numero_empresa'] != '') {
    $retorno = $empresaDAO->pesquisaEmpresa('id', $_POST['numero_empresa']);
    if ($retorno) {
        header("Location: perfil-empresa.php?empresas_id=" . $_POST['numero_empresa']);
        die();
    }
} else {
    $retorno = $empresaDAO->pesquisaEmpresaLimit('nome', $_POST['nome_empresa'], 20);
}

if ($retorno) {
    setcookie("empresas", json_encode($retorno), time() + 2, '/');
    header("Location: " . $pasta . "/empresa-pesquisa.php");
    die();
}

setcookie("resultado_busca_empresa", "false", time() + 2, '/');
setcookie("mensagem_busca_empresa", "Empresa não encontrada.", time() + 2, '/');
header("Location: " . $pasta . "/empresa-pesquisa.php");
die();
