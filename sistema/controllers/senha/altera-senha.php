<?php

use App\DAO\UsuarioDAO;

require_once('../../../vendor/autoload.php');

$senha = $_POST['senha'];
$id_usuario = $_POST['id_usuario'];
$pasta = '../../' . $_POST['pasta'];

$usuario_dao = new UsuarioDAO();
$retorno = $usuario_dao->alteraSenha($id_usuario, $senha);

if($retorno){
    setcookie('altera_senha', 'true', time()+2, '/');
    setcookie('resposta_altera_senha', 'Senha alterada com sucesso.', time()+2, '/');

}else {
    setcookie('altera_senha', 'false', time()+2, '/');
    setcookie('resposta_altera_senha', 'Falha ao alterar senha.', time()+2, '/');
}

header("Location: " . $pasta . "/form-altera-senha.php");
die();
