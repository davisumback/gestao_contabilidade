<?php

use App\DAO\UsuarioDAO;
use App\Usuario\Usuario;

require_once('../../vendor/autoload.php');

if($_FILES['avatar']['error'] == 4){
    $usuario = new Usuario($_POST['usuario'], $_POST['nome'], $_POST['tipo_usuario'], "", 1, $_POST['email'], $_POST['senha']);
}else{
    $diretorio = "../images/avatar/";
	$retorno = move_uploaded_file($_FILES['avatar']['tmp_name'], $diretorio.$_FILES['avatar']['name']);
    $avatar = '../images/avatar/'.$_FILES['avatar']['name'];

    $usuario = new Usuario($_POST['usuario'], $_POST['nome'], $_POST['tipo_usuario'], "", 1, $_POST['email'], $_POST['senha'], $avatar);

	if($retorno == false){
        setcookie("upload_avatar", "false", time()+2, "/");
        setcookie("resposta_upload", "Falha ao fazer upload do avatar.", time()+2, "/");

        header("Location: altera-usuario-form.php");
        die();
	}
}

$usuario->setId($_POST['id']);

$usuario_dao = new UsuarioDAO();
$retorno = $usuario_dao->alteraUsuario($usuario);

if($retorno == true){
    setcookie("alteracao_usuario", "true", time()+2, "/");
    setcookie("resposta_alteracao", "Sucesso ao alterar usuário.", time()+2, "/");
}else {
    setcookie("alteracao_usuario", "false", time()+2, "/");
    setcookie("resposta_alteracao", "Falha ao alterar usuário.", time()+2, "/");
}

header("Location: form-usuario.php");
die();
