<?php

use App\Helper\Simulador;
use App\Helper\Helpers;
use App\DAO\SimuladorDAO;

require_once('../../../vendor/autoload.php');

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$simulador_dao = new SimuladorDAO();

$quantidade_campos = 5;

foreach ($_POST as $chave => $valor) {
    if($_POST[$chave] == ''){
        $_POST[$chave] = 0;
    }
}

$meses = array_chunk($_POST, $quantidade_campos, true);

foreach ($meses as $chave => $valor) {
    $simulador_dao->alteraValoresMensais($valor);
}

header("Location: " . $pasta . "/simulador-resultado-com.php");
die();
