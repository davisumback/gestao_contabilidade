<?php

use App\DAO\SimuladorDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$simuladorDao = new SimuladorDAO();

$retorno = $simuladorDao->salvaSimulacao($_POST['id_simulacao'], $_POST['empresa_numero']);

if($retorno){
    setcookie('mensagem_simulacao', 'Sucesso ao salvar simulação =)', time()+2, '/');
    header("Location: " . $pasta . "/consulta-simulacao.php");
    die();
}else{
    setcookie('erro', 'Falha ao salvar simulação =(', time()+2, '/');
    header("Location: " . $pasta . "/simulador-resultado-com.php");
    die();
}
