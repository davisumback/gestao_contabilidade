<?php
session_start();

function getUsuarioLogado(){
	return $_SESSION['usuario'];
}

function logaUsuario($nome_usuario, $nome_completo, $id, $avatar, $pasta)
{
    $diaPadrao = '01';
    $dataCompetenciaFormatada = new DateTime();
    $dataCompetenciaFormatada->modify('-1 month');
    $dataCompetencia = $dataCompetenciaFormatada->format('Y-m');
    $dataCompetencia .= '-' . $diaPadrao;

    $dataCompetenciaViewFormatada = new DateTime();
    $dataCompetenciaViewFormatada->modify('-1 month');
    $dataCompetenciaView = $dataCompetenciaViewFormatada->format('m/Y');

	$_SESSION['usuario'] = $nome_usuario;
	$_SESSION['nome_completo'] = $nome_completo;
	$_SESSION['id_usuario'] = $id;
	$_SESSION['avatar'] = $avatar;
	$_SESSION['pasta'] = $pasta;
    $_SESSION['dataCompetencia'] = $dataCompetencia;
    $_SESSION['dataCompetenciaView'] = $dataCompetenciaView;
    $_SESSION['diaPadraoCompetencia'] = '01';
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
