<?php
use App\Helper\Helpers;
use App\DAO\UsuarioDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = $_SESSION['pasta'];
$caminho = '../../'.$pasta . '/proposta-comercial.php?prospect=' . $_POST['prospect'];

try {
    $propostaComercial = new \App\Model\Email\PropostaComercialMedcontabil();
    $propostaComercial->setAttributes($_POST);
    $propostaComercial->setHonorarioAtual($_POST['empresas'][1]['honorario'], $_POST['empresas'][1]['decimoTerceiro']);
    $propostaComercial->enviaProposta();
} catch (\Exception $e) {
    setcookie('envioPropostaComercial', 'false', time()+2, '/');
    setcookie('mensagemPropostaComercial', $e->getMessage(), time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('envioPropostaComercial', 'true', time()+2, '/');
setcookie('mensagemPropostaComercial', 'Proposta enviada com sucesso.', time()+2, '/');
header('Location: ' . $caminho);
die();