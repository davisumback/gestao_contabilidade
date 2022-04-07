<?php

use App\DAO\UsuarioDAO;

require_once('../../../vendor/autoload.php');

session_start();
$pasta = '../../' .$_SESSION['pasta'];

$usuario_dao = new UsuarioDAO();

$usuario_dao->ativaDesativaUsuario($_POST['id'], intval($_POST['acao']));

header("Location: " . $pasta . "/form-usuario.php");
die();
