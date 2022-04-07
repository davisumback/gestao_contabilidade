<?php

use App\Entidade\Nota;
use App\DAO\NotaDAO;

require_once('../../../vendor/autoload.php');

$pasta = '../../' . $_POST['pasta'];

if($_POST['data_retorno'] == ""){
    $nota = new Nota($_POST['titulo'], $_POST['texto']);
}else {
    $nota = new Nota($_POST['titulo'], $_POST['texto'], $_POST['data_retorno']);
}

$nota->setId($_POST['id']);

$nota_dao = new NotaDAO();

$retorno = $nota_dao->alteraNotaEmpresa($nota);

if($retorno == false){
    setcookie("insersao_nota", "false", time() + 2, "/");
    setcookie("mensagem_insercao", "Não foi possível alterar a nota.", time() + 2, "/");
}else{
    setcookie("insersao_nota", "true", time() + 2, "/");
    setcookie("mensagem_insercao", "Nota alterada com sucesso.", time() + 2, "/");
}

header("Location: " . $pasta . "/empresa-home.php");
die();
