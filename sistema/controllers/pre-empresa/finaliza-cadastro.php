<?php
use App\DAO\PreEmpresaDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$dao = new PreEmpresaDAO();
$retorno = $dao->finalizaCadastro($_POST['pre_empresa_id']);

if ($retorno == false) {
    setcookie("insercaoFinalizaCadastro", "false", time()+2, '/');
    setcookie("mensagemFinalizaCadastro", "Falha ao confirmar a finalização do cadastro!", time()+2, '/');
}

setcookie("insercaoFinalizaCadastro", "true", time()+2, '/');
setcookie("mensagemFinalizaCadastro", "Sucesso ao confirmar a finalização do cadastro!", time()+2, '/');
header("Location: " . $pasta . '/pipedrive-socios.php');
die();
