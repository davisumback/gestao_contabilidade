<?php

use App\DAO\TipoUsuarioDAO;
use App\DAO\UsuarioDAO;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastrar Usuário");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php
$tipo_usuario_dao = new TipoUsuarioDAO();
$perfis = $tipo_usuario_dao->getPerfis();

$usuario_dao = new UsuarioDAO();
$usuarios = $usuario_dao->getTodosUsuarios();
?>

<div class="text-center mb-2">
    <?=Mensagem::getMensagem($_COOKIE, 'usuario_cadastrado', 'resposta_usuario_cadastrado');?>
</div>
<div class="text-center mb-2">
    <?=Mensagem::getMensagem($_COOKIE, 'insercao_usuario', 'resposta_insersao');?>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Área para edição de todos os Usuários do nosso sistema
        </div>
        <div class="card-body">
            <div class="text-right mb-3">
                <button data-toggle="modal" data-target="#novo-usuario" class="btn btn-success btn-padrao font-weight-bold" type="submit">Novo Usuário</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="label-cadastro text-center">
                        <tr>
                            <th scope="col">Avatar</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ativo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="texto-table text-center">
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td><img class="user-avatar rounded-circle avatar" src="<?=$usuario['avatar']?>"></td>
                                <td class="font-weight-bold"><?=$usuario['usuario']?></td>
                                <td class="font-weight-bold"><?=$usuario['nome_tipo']?></td>
                                <td class="font-weight-bold"><?=$usuario['email']?></td>
                                <td class="font-weight-bold"><?=($usuario['ativo'] == 1) ? 'Sim' : 'Não'?></td>
                                <td>
                                    <form class="d-inline-block needs-validation-loading" action="altera-usuario-form.php" method="post">
                                        <input name="id" value="<?=$usuario['id']?>" hidden>
                                        <button type="submit" class="btn btn-info btn-sm btn-padrao font-weight-bold">Editar</button>
                                    </form>
                                    <form class="d-inline-block needs-validation-loading" action="../controllers/usuario/desativa-usuario.php" method="post">
                                        <input name="id" value="<?=$usuario['id']?>" hidden>
                                        <?php if($usuario['ativo'] == 1) : ?>
                                            <input name="acao" value="0" hidden>
                                            <button type="submit" class="btn btn-warning btn-sm btn-padrao font-weight-bold">Desativar</button>
                                        <?php else : ?>
                                            <input name="acao" value="1" hidden>
                                            <button type="submit" class="btn btn-success btn-sm btn-padrao font-weight-bold">Ativar</button>
                                        <?php endif ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="novo-usuario" tabindex="-1" role="dialog" aria-labelledby="novo-usuario" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Novo Usuário</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-insere-usuario" class="needs-validation-loading" action="../controllers/usuario/insere-usuario.php" method="post" enctype="multipart/form-data" novalidate autocomplete="off" style="margin-bottom:0;">
                        <div class="row">
                            <div class="col-md-6 mb-3 label-cadastro">
                                <label for="nome-usuario">Usuário</label>
                                <input name="usuario" type="text" class="form-control" id="usuario" placeholder="Ex: primeironome.últimonome" maxlength="50" required autofocus>
                                <div class="invalid-feedback">
                                    Digite um usuário válido.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 label-cadastro">
                                <label for="senha">Senha</label>
                                <input name="senha" type="password" class="form-control col-md-6" id="senha" maxlength="30" required>
                                <div class="invalid-feedback">
                                    Digite uma senha válida.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 label-cadastro">
                                <label for="nome-completo">Nome Completo</label>
                                <input name="nome" type="text" class="form-control" id="nome-completo" maxlength="80" required>
                                <div class="invalid-feedback">
                                    Digite um nome válido.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nome-completo" class="label-cadastro">Escolha uma foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="avatar" type="file" class="custom-file-input" onchange='jQuery("#escolha").html(jQuery(this).val());'>
                                        <label id="escolha" class="custom-file-label" for="validatedCustomFile">Escolha arquivo...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 label-cadastro">
                                <label for="email-usuario">Email</label>
                                <input name="email" type="text" class="form-control" id="email-usuario" placeholder="exemplo@exemplo.com.br" maxlength="50" required>
                                <div class="invalid-feedback">
                                    Digite um nome válido.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 label-cadastro">
                                <label for="tipo-usuario">Perfil</label>
                                <select name="tipo_usuario" class="custom-select d-block w-100" id="tipo-usuario" required>
                                    <option value="">Escolha...</option>
                                    <?php foreach($perfis as $perfil) : ?>
                                        <option value="<?=$perfil['tipo']?>"><?=$perfil['nome_tipo']?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    Escolha um perfil.
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-5">
                            <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Cadastrar</button>
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
