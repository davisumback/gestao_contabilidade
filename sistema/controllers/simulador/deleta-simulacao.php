<?php

use App\DAO\SimuladorDAO;

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$simuladorDao = new SimuladorDAO();
$retorno = $simuladorDao->deletaSimulacaoEmpresa($_POST['empresa_numero'], $_POST['simulacao_id']);

if($retorno){
    $empresasSimulacoes = $simuladorDao->getSimulacaoEmpresa($_POST['empresa_numero']);
    setcookie('empresas_simulacoes', json_encode($empresasSimulacoes), time()+2, '/');
    setcookie('mensagem_simulacao', 'Simulação deletada com sucesso =)');

}else {
    setcookie('mensagem_simulacao', 'Falha ao deletar simulação =(');
}

header("Location: " . $pasta . "/consulta-simulacao.php");
die();
