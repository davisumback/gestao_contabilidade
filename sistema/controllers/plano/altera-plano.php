<?php
use App\DAO\PlanoDAO;
use App\Helper\Helpers;

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$nome = $_POST['nome'];
$valor = Helpers::formataMoedaBd($_POST['valor']);
$id = $_POST['id'];

$planoDao = new PlanoDAO();
$retorno = $planoDao->alteraPlano($nome, $valor, $id);

if($retorno){
    setcookie('resultado_insercao', 'true', time()+2, '/');
    setcookie('mensagem_insercao', 'Sucesso ao alterar o Plano.', time()+2, '/');
}else{
    setcookie('resultado_insercao', 'false', time()+2, '/');
    setcookie('mensagem_insercao', 'Falha ao alterar Plano.', time()+2, '/');
}

header("Location: " . $pasta . "/form-plano.php");
die();
