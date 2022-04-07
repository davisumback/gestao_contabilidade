<?php

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$caminho = '../../' . $_SESSION['pasta'] . '/pis.php';

if (empty($_POST)) {
    setcookie('insercaoPis', 'false', time()+2, '/');
    setcookie('mesangemInsercaoPis', 'Você não pode acessar essa área do sistema.', time()+2, '/');
    header('Location: ' . $caminho);
    die();    
}

$dao = new \App\DAO\ClienteDAO();
$retorno = $dao->updatePisCliente($_POST['clientesId'], $_POST['pis']);

if ($retorno == false) {
    setcookie('insercaoPis', 'false', time()+2, '/');
    setcookie('mesangemInsercaoPis', 'Falha ao salvar o PIS.', time()+2, '/');
    header('Location: ' . $caminho);
    die();    
}

setcookie('insercaoPis', 'true', time()+2, '/');
setcookie('mesangemInsercaoPis', 'Sucesso ao cadastrar o PIS.', time()+2, '/');
header('Location: ' . $caminho);
die();