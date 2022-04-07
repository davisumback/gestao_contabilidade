<?php
use App\DAO\PlanoDAO;
use App\Helper\Helpers;

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$planoDao = new PlanoDAO();
$valor = Helpers::formataMoedaBd($_POST['valor']);
$retorno = $planoDao->inserePlano($_POST['nome'], $valor);

if($retorno){
    setcookie('resultado_insercao', 'true', time()+2, '/');
    setcookie('mensagem_insercao', 'Sucesso ao criar Plano.', time()+2, '/');
}else{
    setcookie('resultado_insercao', 'false', time()+2, '/');
    setcookie('mensagem_insercao', 'Falha ao criar Plano.', time()+2, '/');
}

header("Location: " . $pasta . "/form-plano.php");
die();
