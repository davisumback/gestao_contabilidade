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
        if ($_SESSION['pasta'] == "view-gestor" or $_SESSION['pasta'] == "view-administrador") {
            header("Location: " . $pasta . "/empresa-home.php");        
        }else {
            header("Location: " . $pasta . "/empresa-dados.php");            
        }
        die();
    }else {
        setcookie("resultadoInfosEmpresa", "false", time()+2, '/');
        setcookie("mensagemInfosEmpresa", "Empresa não encontrada.", time()+2, '/');
        header("Location: " . $pasta . "/empresa-pesquisa.php");
        die();
    }

}else{
    $retorno = $empresaDAO->pesquisaEmpresaCompleta($_POST['empresas_id']);
}

if($retorno){
    $_SESSION['viewIdEmpresa'] = $retorno[0]['id'];
    $_SESSION['viewNomeEmpresa'] = $retorno[0]['nome_empresa'];
    $_SESSION['infosEmpresa'] = json_encode($retorno);
    if ($_SESSION['pasta'] == "view-gestor") {
        header("Location: " . $pasta . "/empresa-home.php");        
    }else {
        header("Location: " . $pasta . "/empresa-dados.php");
    }
    die();
}

setcookie("resultadoInfosEmpresa", "false", time()+2, '/');
setcookie("mensagemInfosEmpresa", "Falha ao acessar perfil da empresa selecionada.", time()+2, '/');
header("Location: " . $pasta . "/empresa-pesquisa.php");
die();
