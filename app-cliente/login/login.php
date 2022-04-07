<?php

use App\DAO\ClienteDAO;
use App\Helper\Helpers;

require_once('../../vendor/autoload.php');
require_once('../../banco/conecta-medb.php');
require_once('logica-usuario.php');

$cpf = Helpers::formataCpfBd($_POST['cpf']);

$cliente_dao = new ClienteDAO($conexao);
$cliente = $cliente_dao->verificaUsuarioESenha($cpf, $_POST['senha']);

if($cliente == null){
	setcookie('login_invalido', 'true', time() + 2, '/');
	setcookie('mensagem_login_invalido', 'Usuário ou senha inválidos.', time() + 2, '/');
	header("Location: ../index.php");
	die();

}elseif (intval($cliente['ativo']) == 0) {
	setcookie('usuario_inativo', 'true', time() + 2, '/');
	setcookie('mensagem_usuario_inativo', 'Seu usuário está inativo.', time() + 2, '/');
	header("Location: ../index.php");
	die();
}

logaCliente($cpf, $cliente['nome_completo'], $cliente['id']);
header("Location: ../cliente-view/index.php");
die();
