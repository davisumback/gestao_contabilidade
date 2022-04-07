<?php
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

$empresaId = $_SESSION['empresasId'];

?>

<div class="container-fluid">
    <div class="content" id="conteudo">

        <div class="container">
            <?=\App\Helper\Mensagem::getMensagem($_COOKIE, 'resultadoUploadArquivo', 'mensagemUploadArquivo')?>
        </div>

        <div class="row mt-3 mb-4 justify-content-around">            
            <div class="col text-center">
                <button type="button" class="btn mb-2 btn-padrao btn-sm btn-cor-primaria" data-toggle="modal" data-target="#modalDocContabilidade" >Documentos Contabilidade</button>
                <button type="button" class="btn mb-2 btn-padrao btn-sm btn-cor-primaria" data-toggle="modal" data-target="#modalDocRh">Documentos RH</button>
            </div>

            <?php Mensagem::getMensagem($_COOKIE, 'insercaoUploadArquivo', 'mensagemUploadArquivo'); ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/cliente-medcontabil/doc-contabilidade.php'; ?>
<?php include __DIR__ . '/../modal/cliente-medcontabil/doc-rh.php'; ?>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
?>

<script>

    // $('#modalDocContabilidade').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget)
    //     var id = button.data('doc-contabilidade')

    //     var modal = $(this)

    //     modal.find('#doc-conta').val(id)
    // });

    $('#dataValidade').mask('00/00/0000');
</script>