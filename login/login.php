<?php
use App\DAO\UsuarioDAO;

require_once('../vendor/autoload.php');
require_once('logica-usuario.php');

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->verificaUsuarioESenha($_POST['usuario'], $_POST['senha']);

if($usuario == null){
	setcookie('login_valido', 'false', time() + 2, '/');
	setcookie('mensagem_login_invalido', 'Usuário ou senha inválidos.', time() + 2, '/');
	header("Location: ../index.php");
	die();

}elseif ($usuario['ativo'] == 0) {
	setcookie('usuario_ativo', 'false', time() + 2, '/');
	setcookie('mensagem_usuario_inativo', 'Seu usuário está inativo.', time() + 2, '/');
	header("Location: ../index.php");
	die();
}
else{
	setView(intval($usuario['tipo']), $usuario['usuario'], $usuario['nome_completo'], $usuario['id'], $usuario['avatar'], $usuario['pasta']);
}

function setView($tipo_usuario, $usuario, $nome_completo, $id, $avatar, $pasta){

	switch ($tipo_usuario) {
		case 1:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 2:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 3:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 4:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 5:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 6:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 7:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 8:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 9:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		case 10:
			setcookie('login_valido', 'false', time() + 2, '/');
			setcookie('mensagem_login_invalido', 'Agora você faz o login através do site: https://www.medcontabil.com.br', time() + 2, '/');
			header("Location: ../index.php");
			die();
			break;
		case 13:
			logaUsuario($usuario, $nome_completo, $id, $avatar, $pasta);
			header("Location: ../sistema/".$pasta."/index.php");
			die();
			break;
		default:
			setcookie('login_valido', 'false', time() + 2, '/');
			setcookie('mensagem_login_invalido', 'Agora você faz o login através do site: https://www.medcontabil.com.br', time() + 2, '/');
			header("Location: ../index.php");
			die();
			break;
	}
}
