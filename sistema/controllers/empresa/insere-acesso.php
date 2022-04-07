<?php

use App\DAO\EmpresaAcessoDAO;

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$empresaAcesso = new EmpresaAcessoDAO();
$retorno = $empresaAcesso->insereAcesso($_POST['empresas_id'], $_POST['site'], $_POST['login'], $_POST['senha']);

if($retorno){
    setcookie("resultado_insercao_acesso", "true", time()+2, '/');
    setcookie("mensagem_insercao_acesso", "Sucesso ao inserir acesso.", time()+2, '/');
    header("Location: " . $pasta . "/empresa-dados.php");
    die();
}

setcookie("resultado_insercao_acesso", "false", time()+2, '/');
setcookie("mensagem_insercao_acesso", "Falha ao inserir acesso.", time()+2, '/');
header("Location: " . $pasta . "/empresa-dados.php");
die();
