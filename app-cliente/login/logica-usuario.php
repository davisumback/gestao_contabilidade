<?php
session_start();

function getUsuarioLogado(){
	return $_SESSION['usuario'];
}

function logaCliente($cpf, $nome_completo, $id){
	$_SESSION['cpf'] = $cpf;
	$_SESSION['nome_completo'] = $nome_completo;
	$_SESSION['id_cliente'] = $id;
}

function isUsuarioLogado(){
	return isset($_SESSION['usuario']);
}

function verificaUsuario(){
	if(!isUsuarioLogado()){
		$_SESSION['danger'] = 'Você não tem acesso a essa área';
		header("Location: area-restrita.php");
		die();
	}
}

function logout(){
	unset($_SESSION);
	setcookie('PHPSESSID', null, -1, '/');
	session_destroy();
}
