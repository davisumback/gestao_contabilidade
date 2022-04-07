<?php
use App\DAO\ApiDAO;

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$dao = new ApiDAO();
$retorno = $dao->ativaDesativaApi($_POST['id'], $_POST['status']);

if ($retorno == false) {
    setcookie('ativa_desativa_api', 'false', time()+2, '/');
    setcookie('mensagem', 'Falha ao ativar/desativar essa API!', time()+2, '/');
}

header('Location: ' . $pasta  . '/form-api.php');
die();
