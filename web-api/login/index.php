<?php

header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
//header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');

use App\DAO\UsuarioDAO;

require_once '../../vendor/autoload.php';
require_once '../../banco/conecta-medb.php';

$entrada = file_get_contents('php://input');

$usuarioDao = new UsuarioDAO($conexao);

$decoded = json_decode($entrada, true);

$retorno = $usuarioDao->verificaUsuarioESenha($decoded['usuario'], $decoded['senha']);

if($retorno == null){
    echo 'false';
}else{
    echo 'true';
}
