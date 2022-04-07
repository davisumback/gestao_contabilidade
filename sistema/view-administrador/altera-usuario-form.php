<?php

if(!array_key_exists('id', $_POST)){
    header("Location: lista-usuarios.php");
    die();
}

use App\DAO\TipoUsuarioDAO;
use App\DAO\UsuarioDAO;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Editar Usuário");
require_once('menu-left.php');
require_once('../cabecalho.php');

$tipo_usuario_dao = new TipoUsuarioDAO();
$perfis = $tipo_usuario_dao->getPerfis();

$usuario_dao = new UsuarioDAO();
$usuario = $usuario_dao->getUsuario($_POST['id']);
?>

<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Alterar Usuário
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-md-10 offset-md-1">
                    <form class="needs-validation-loading" action="altera-usuario.php" method="post" enctype="multipart/form-data" novalidate>
                        <input name="id" value="<?=$_POST['id']?>" hidden>
                        <div class="row">
                            <div class="col-md-6 mb-3 label-cadastro">
                                <label for="nome-usuario">Usuário</label>
                                <input value="<?=$usuario['usuario']?>" name="usuario" type="text" class="form-control" id="usuario" placeholder="Ex: primeironome.últimonome" maxlength="50" required autofocus>
                                <div class="invalid-feedback">
                                    Digite um usuário válido.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 label-cadastro">
                                <label for="senha">Senha</label>
                                <input value="<?=$usuario['senha']?>" name="senha" type="password" class="form-control col-md-6" id="senha" maxlength="30" required>
                                <div class="invalid-feedback">
                                    Digite uma senha válida.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 label-cadastro">
                                <label for="nome-completo">Nome Completo</label>
                                <input value="<?=$usuario['nome_completo']?>" name="nome" type="text" class="form-control" id="nome-completo" maxlength="80" required>
                                <div class="invalid-feedback">
                                    Digite um nome válido.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nome-completo" class="label-cadastro">Escolha uma foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="avatar" type="file" class="custom-file-input" onchange='jQuery("#escolha").html(jQuery(this).val());'>
                                        <label id="escolha" class="custom-file-label" for="validatedCustomFile"><?=$usuario['avatar']?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 label-cadastro">
                                <label for="email-usuario">Email</label>
                                <input value="<?=$usuario['email']?>" name="email" type="text" class="form-control" id="email-usuario" placeholder="exemplo@exemplo.com.br" maxlength="50" required>
                                <div class="invalid-feedback">
                                    Digite um nome válido.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 label-cadastro">
                                <label for="tipo-usuario">Perfil</label>
                                <select name="tipo_usuario" class="custom-select d-block w-100" id="tipo-usuario" required>
                                    <option value="">Escolha...</option>
                                    <?php foreach($perfis as $perfil) : ?>
                                        <?php
                                            $selecao = "";
                                            if($perfil['tipo'] == $usuario['tipo']){
                                                $selecao = "selected=true";
                                            };
                                        ?>
                                        <option value="<?=$perfil['tipo']?>" <?=$selecao?>> <?=$perfil['nome_tipo']?> </option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    Escolha um perfil.
                                </div>
                            </div>
                        </div>
                        <div class="text-center mb-5 mt-4">
                            <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Alterar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>
