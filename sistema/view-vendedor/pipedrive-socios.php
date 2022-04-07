<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Lista de empresas pendentes de cadastro ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');

use App\DAO\PreEmpresaDAO;
use App\Helper\Helpers;
use App\Helper\Mensagem;

$dao = new PreEmpresaDAO();
$empresas = $dao->getPreEmpresasAConfirmar('LTDA');
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'insercaoFinalizaCadastro', 'mensagemFinalizaCadastro');?>
    <?=Mensagem::getMensagem($_COOKIE, 'insercaoSocio', 'mensagemSocio');?>

    <div class="row">
        <div class="col-md-12">
            <?php if(empty($empresas)) : ?>
                <div class="alert alert-success mt-2 text-center" role="alert">
                    <h6 class="alert-heading">Você não possui confirmações à fazer ;)</h6>
                </div>
            <?php else : ?>
                <div class="text-center mb-3">
                    <div class="alert alert-success" role="alert">
                        <h6>Lista de empresas vindas do <strong>Pipedrive</strong> que precisam de confirmação de sócios</h6>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="label-cadastro">
                            <tr>
                                <th scope="col">SÓCIO</th>
                                <th scope="col">PORCENTAGEM</th>
                                <th scope="col">EMPRESA</th>
                                <th scope="col">TIPO SOCIETÁRIO</th>
                                <th scope="col">OPÇÃO 1</th>
                                <th scope="col">OPÇÃO 2</th>
                                <th scope="col">OPÇÃO 3</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody class="texto-table">
                            <?php foreach ($empresas as $empresa) : ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><?=$empresa['id']?></td>
                                    <td><?=$empresa['tipo_societario']?></td>
                                    <td><?=$empresa['nome_1']?></td>
                                    <td><?=$empresa['nome_2']?></td>
                                    <td><?=$empresa['nome_3']?></td>
                                    <td>
                                        <form class="mb-0" action="pipedrive-incluir-socio.php" class="needs-validation-loading" method="post">
                                            <input name="pre_empresa_id" value="<?=$empresa['id']?>" hidden>
                                            <button type="submit" class="btn btn-padrao btn-info btn-sm">Incluir sócio</button> </td>
                                        </form>
                                    <td>
                                        <button data-toggle="modal" data-target="#finalizar-cadastro" class="btn btn-padrao btn-warning btn-sm" type="button">Finalizar cadastro</button>
                                    </td>
                                </tr>

                                <?php $socios = $dao->getPreSocios($empresa['id']); ?>
                                <?php foreach ($socios as $socio) : ?>
                                    <tr>
                                        <td class="text-center"><?=$socio['nome_completo']?></td>
                                        <td class="text-center"><?=Helpers::formataMoedaView($socio['porcentagem_societaria'])?> %</td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="modal fade" id="finalizar-cadastro" tabindex="-1" role="dialog" aria-labelledby="finalizar-cadastro" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title label-cadastro">Finalizar cadastro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <h6 class="text-secondary">Ao confirmar a finalização do cadastro, você não poderá incluir mais sócios posteriormente.</h6>
                    </div>
                </div>

                <form id="form-insere-ies" action="../controllers/pre-empresa/finaliza-cadastro.php" method="post" class="mb-0" novalidate autocomplete="off">
                    <input name="pre_empresa_id" value="<?=$empresa['id']?>" hidden>

                    <div class="modal-footer">
                        <button class="btn btn-cadastrar" type="submit">Confirmar</button>
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
    function vaiPerfil(id){
        window.location = 'pipedrive-cliente.php?clienteId=' + id;
    }
</script>
