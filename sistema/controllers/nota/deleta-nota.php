<?php

use App\DAO\NotaDAO;

require_once('../../../vendor/autoload.php');

$nota_dao = new NotaDAO();

$retorno = $nota_dao->deletaNota($_POST['id']);
$pasta = '../../' . $_POST['pasta'];

if($retorno == false){
    setcookie("deleta_nota", "false", time() + 2, "/");
    setcookie("mensagem_deleta", "Não foi possível apagar a nota.", time() + 2, "/");
}else{
    setcookie("deleta_nota", "true", time() + 2, "/");
    setcookie("mensagem_deleta", "Nota apagada com sucesso.", time() + 2, "/");
}

header("Location: " . $pasta . "/form-nota.php");
die();
