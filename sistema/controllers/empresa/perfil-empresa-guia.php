<?php
use App\DAO\EmpresaDAO;

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$empresaDAO = new EmpresaDAO();

if(array_key_exists('empresas_id', $_GET)){
    $retorno = $empresaDAO->pesquisaEmpresaCompleta($_GET['empresas_id']);

    if($retorno){
        $_SESSION['viewIdEmpresa'] = $retorno[0]['id'];
        $_SESSION['viewNomeEmpresa'] = $retorno[0]['nome_empresa'];
        $_SESSION['infosEmpresa'] = json_encode($retorno);
        header("Location: " . $pasta . "/empresa-guias.php");
        die();
    }else {
        setcookie("resultadoInfosEmpresa", "false", time()+2, '/');
        setcookie("mensagemInfosEmpresa", "Empresa não encontrada.", time()+2, '/');
        header("Location: " . $pasta . "/empresa-pesquisa.php");
        die();
    }
}

setcookie("resultadoInfosEmpresa", "false", time()+2, '/');
setcookie("mensagemInfosEmpresa", "Falha ao acessar perfil da empresa selecionada.", time()+2, '/');
header("Location: " . $pasta . "/empresa-pesquisa.php");
die();
