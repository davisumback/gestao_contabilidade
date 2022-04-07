<?php

session_start();
$pastaView = '../../' . $_SESSION['pasta'];

function montaRetornoPasta($caminhoCompleto){
    $saida = '';
    $arrayCaminho = explode('/', $caminhoCompleto);

    for($i = 0; $i < sizeof($arrayCaminho) - 2; $i++){
        $saida .= $arrayCaminho[$i] . '/';
    }

    return $saida;
}

function ApagaDir($dir) {
    if(!is_dir($dir)){
        return unlink($dir);
    }
    if($objs = glob($dir."/*")){
        foreach($objs as $obj) {
            is_dir($obj)? ApagaDir($obj) : unlink($obj);
        }
    }
    return rmdir($dir);
}

$diretorioParaApagar = '../' . $_GET['dir'];
$retorno = ApagaDir($diretorioParaApagar);

$diretorioRetorno = $_GET['dir'];
if(array_key_exists('a', $_GET) && $_GET['a'] == 1){
    $diretorioRetorno  = substr($_GET['dir'], 0, strrpos($_GET['dir'], '/') + 1);
}else{
    $diretorioRetorno = montaRetornoPasta($_GET['dir']);
}

if($retorno){
    header("Location: " . $pastaView . "/empresa-arquivos.php?dir=".$diretorioRetorno);
    die();
}
