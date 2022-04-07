<?php

use App\DAO\SimuladorDAO;

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$simuladorDao = new SimuladorDAO();

$empresaNumero = $_POST['empresa_numero'];

$empresasSimulacoes = $simuladorDao->getSimulacaoEmpresa($empresaNumero);

if(empty($empresasSimulacoes)){
    setcookie('resposta_mensagem_simulacao', 'false', time()+2, '/');
    setcookie('mensagem_simulacao', 'Esta empresa não possui simulações', time()+2, '/');
}else {
    setcookie('empresas_simulacoes', json_encode($empresasSimulacoes), time()+2, '/');
}

header("Location: " . $pasta . "/consulta-simulacao.php");
die();
