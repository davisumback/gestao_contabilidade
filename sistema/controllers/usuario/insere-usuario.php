<?php

use App\DAO\UsuarioDAO;
use App\Usuario\Usuario;

require_once('../../../vendor/autoload.php');

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$usuario_dao = new UsuarioDAO();
$retorno = $usuario_dao->isUsuarioCadastrado($_POST['usuario']);

if($retorno != null){
    setcookie("usuario_cadastrado", "true", time()+2, "/");
    setcookie("resposta_usuario_cadastrado", "Usuário: ".$_POST['usuario']. " já em uso." , time()+2, "/");
    header("Location: " . $pasta . "/form-usuario.php");
    die();
}

if($_FILES['avatar']['error'] == 4){
    $avatar = '../images/avatar/sem.foto.jpg';
}else{
    $diretorio = "../../images/avatar/";
	$retorno = move_uploaded_file($_FILES['avatar']['tmp_name'], $diretorio.$_FILES['avatar']['name']);
    $avatar = '../images/avatar/'.$_FILES['avatar']['name'];

	if($retorno == false){
        setcookie("insercao_usuario", "false", time()+2, "/");
        setcookie("resposta_insersao", "Falha ao fazer upload do avatar.", time()+2, "/");

        header("Location: " . $pasta . "/form-usuario.php");
        die();
	}
}

date_default_timezone_set('America/Sao_Paulo');
$data_criacao = date('Y-m-d');

$usuario = new Usuario($_POST['usuario'], $_POST['nome'], $_POST['tipo_usuario'], $data_criacao, 1, $_POST['email'], $_POST['senha'], $avatar);

$retorno = $usuario_dao->insereUsuario($usuario);

if($retorno == true){
    setcookie("insercao_usuario", "true", time()+2, "/");
    setcookie("resposta_insersao", "Sucesso ao cadastrar usuário.", time()+2, "/");
}else {
    setcookie("insercao_usuario", "false", time()+2, "/");
    setcookie("resposta_insersao", "Falha ao cadastrar usuário.", time()+2, "/");
}

header("Location: " . $pasta . "/form-usuario.php");
die();
