<?php

use App\DAO\PlanoDAO;
use App\Helper\Helpers;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastrar Plano");
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new PlanoDAO();
$planos = $dao->getTodosPlanos();
?>

<div id="carregando" class="center" hidden>
    <div class="loading">
    </div>
</div>
<div class="container" id="conteudo">
    <div class="text-center mb-3">
        <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao', 'mensagem_insercao');?>
    </div>
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Área para edição de todos os Planos do nosso sistema
        </div>
        <div class="card-body">
            <div class="text-center mb-3">
                <button data-toggle="modal" data-target="#novo-plano" class="btn btn-success btn-edita-usuario font-weight-bold" type="submit">Novo Plano</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="label-cadastro">
                        <tr>
                            <th scope="col">Plano</th>
                            <th scope="col">Valor</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="texto-table">
                        <?php foreach ($planos as $plano) : ?>
                            <tr>
                                <td><?=$plano['nome']?></td>
                                <td>R$ <?=Helpers::formataMoedaView($plano['valor'])?></td>
                                <td class="text-center">
                                    <button
                                        data-toggle="modal"
                                        data-target="#altera-plano"
                                        data-id-plano="<?=$plano['id']?>"
                                        data-nome-plano="<?=$plano['nome']?>"
                                        data-altera-valor-plano="<?=$plano['valor']?>"
                                        type="button"
                                        class="btn btn-info btn-sm btn-edita-usuario font-weight-bold">
                                            Editar
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button
                                        data-toggle="modal"
                                        data-target="#deleta-plano"
                                        data-id-plano="<?=$plano['id']?>"
                                        type="button"
                                        class="btn btn-danger btn-sm btn-edita-usuario font-weight-bold">
                                            Deletar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="novo-plano" tabindex="-1" role="dialog" aria-labelledby="novo-plano" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Novo Plano</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-novo-plano" action="../controllers/plano/insere-plano.php" method="post" class="needs-validation-loading" novalidate autocomplete="off" style="margin:0;">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="nome-plano" class="label-cadastro">Nome do Plano</label>
                                        <input name="nome" type="text" class="form-control" maxlength="40" id="nome-plano" required>
                                        <div class="invalid-feedback">
                                            Digite um nome de Plano válido.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="valor-plano" class="label-cadastro">Valor</label>
                                        <input name="valor" type="text" class="form-control col-md-10" id="valor-plano" required>
                                        <div class="invalid-feedback">
                                            Digite um valor válido.
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer mt-5">
                                    <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Cadastrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleta-plano" tabindex="-1" role="dialog" aria-labelledby="deleta-plano" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Deletar Plano</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text text-danger">Tem certeza que deseja deletar?</h5>
                    <div class="text-right mt-2">
                        <form id="form-deleta-plano" class="d-inline-block" action="../controllers/plano/deleta-plano.php" method="post">
                            <input name="id" id="id-deleta-plano" hidden>
                            <button type="submit" class="btn btn-danger btn-padrao font-weight-bold">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="altera-plano" tabindex="-1" role="dialog" aria-labelledby="altera-plano" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Editar Plano</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-altera-plano" action="../controllers/plano/altera-plano.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                    <input name="id" class="form-control" id="id" hidden>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="nome-plano" class="label-cadastro col-form-label">Nome Plano</label>
                                <input name="nome" type="text" class="form-control" id="nome-plano" required>
                            </div>
                            <div class="col-6">
                                <label for="altera-valor-plano" class="label-cadastro col-form-label">Valor</label>
                                <input name="valor" type="text" class="form-control" id="altera-valor-plano" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-info btn-padrao font-weight-bold" type="submit">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#deleta-plano').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id-plano');
        var modal = $(this);
        modal.find('#id-deleta-plano').val(id);
    })

    $('#altera-plano').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id-plano') // Extract info from data-* attributes
        var nome = button.data('nome-plano') // Extract info from data-* attributes
        var valor = button.data('altera-valor-plano') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#id').val(id)
        modal.find('#nome-plano').val(nome)
        modal.find('#altera-valor-plano').val(valor)
    })
</script>

<script type="text/javascript">
    $('#valor-plano').mask('000.000.000,00', {reverse: true});
    $('#altera-valor-plano').mask('000.000.000,00', {reverse: true});
</script>
