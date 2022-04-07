<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']);

if (!array_key_exists('viewIdEmpresa', $_SESSION)) {
    header("Location: empresa-pesquisa.php");
    die();
}

require_once('menu-left.php');
require_once('../cabecalho.php');

$arquivoRetorno = 'empresa-cnae.php';

$empresaId = $_SESSION['viewIdEmpresa'];
$empresaCnae = new \App\Model\Empresa\EmpresaCnae();
$cnaes = $empresaCnae->getCnaeCadastrados($_SESSION['viewIdEmpresa']);
?>

<?=Mensagem::getMensagem($_COOKIE, 'resultadoInsercaoConta', 'mensagemInsercaoConta');?>

<?php if (! empty($cnaes)) : ?>
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            CNAEs da Empresa <?= $_SESSION['viewNomeEmpresa']?>
        </div>
        <div class="card-body">
            <div class="text-right mb-3">
                <button data-toggle="modal" data-target="#insere-novo-cnae" class="btn btn-success btn-padrao" type="button"><strong>Novo CNAE</strong></button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-success label-cadastro">
                        <tr>
                            <th></th>
                            <th>Número</th>
                            <th>Descrição</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="texto-table">
                        <?php foreach ($cnaes as $cnae) : ?>
                            <tr>                                
                                <td class="label-cadastro">
                                    <?php if ($cnae['principal'] == 'SIM') : ?>
                                        <button class="btn btn-padrao btn-sm btn-cor-primaria font-weight-bold">Principal</button>
                                    <?php endif?>
                                </td>
                                <td class="label-cadastro"><?=Helpers::mask($cnae['cnae'], '####-#/##')?></td>
                                <td class="label-cadastro"><?=$cnae['descricao']?></td>
                                <td class="label-cadastro">                                    
                                    <button
                                        data-toggle="modal"
                                        data-target="#edita-cnae"
                                        data-cnae-id="<?=$cnae['id']?>"
                                        data-cnae="<?=Helpers::mask($cnae['cnae'], '####-#/##')?>"
                                        data-descricao="<?=$cnae['descricao']?>"
                                        type="button"
                                        class="btn btn-padrao btn-warning font-weight-bold btn-sm">
                                            Editar
                                    </button>

                                    <?php if ($cnae['principal'] == 'NAO') : ?>
                                        <button
                                            data-toggle="modal"
                                            data-target="#deleta-cnae"
                                            data-cnae-id="<?=$cnae['id']?>"
                                            data-cnae-principal="<?=$cnae['principal']?>"
                                            data-cnae="<?=$cnae['cnae']?>"
                                            type="button"
                                            class="btn btn-padrao btn-danger font-weight-bold btn-sm">
                                                Apagar
                                        </button>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="text-danger">Nenhuma conta cadastrada.</strong>
    </div>
<?php endif ?>

<?php include __DIR__ . '/../modal/empresa/cnae/insere-novo.php'; ?>
<?php include __DIR__ . '/../modal/empresa/cnae/edita.php'; ?>
<?php include __DIR__ . '/../modal/empresa/cnae/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#edita-cnae').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var idCnae = button.data('cnae-id'); 
        var cnae = button.data('cnae'); 
        var descricao = button.data('descricao');

        var modal = $(this);
        modal.find('#idCnae').val(idCnae);
        modal.find('#editaCnae').val(cnae);
        modal.find('#descricao').val(descricao);

    });    

    $('#deleta-cnae').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var idCnae = button.data('cnae-id'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('#idDeletaCnae').val(idCnae);
    });   

    $(document).ready(function(){
        $('.cnae').mask('0000-0/00');
    });    

</script>