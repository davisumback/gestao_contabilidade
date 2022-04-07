<?php

use App\Arquivo\NavegadorArquivos;

require_once('header.php');
require_once('menu-topo.php');

if(!array_key_exists('viewIdEmpresa', $_SESSION)) {
    header("Location: empresa-pesquisa.php");
    die();
}

$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']);
require_once('menu-left.php');
require_once('../cabecalho.php');

$numeroEmpresa = $_SESSION['viewIdEmpresa'];
NavegadorArquivos::setNomeDaPagina('empresa-arquivos.php');
NavegadorArquivos::setDiretorioEmpresa($numeroEmpresa);
NavegadorArquivos::getCaminhoDiretorioAtual($_GET);
NavegadorArquivos::getCaminhoVoltar();
?>

<div class="row">
    <div class="col-12 mx-auto text-center">
        <?=NavegadorArquivos::criaMenuNavegacao();?>
    </div>
</div>

<div class="row">
    <?=NavegadorArquivos::criaNavegadorDeArquivos();?>
</div>

<?php
    NavegadorArquivos::liberaDiretorio();
?>

<?php
    $caminhoRaizEmrpesa = '../../grupobfiles/empresas/' . $numeroEmpresa . '/';
    $diretorioAtual = (!array_key_exists('dir', $_GET)) ? $caminhoRaizEmrpesa : $_GET['dir'];
?>

<?php $_SESSION['diretorio_base'] = $diretorioAtual?>

<div class="modal fade" id="upload-arquivos" tabindex="-1" role="dialog" aria-labelledby="upload-arquivos" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title label-cadastro">Upload de Arquivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/navegador-arquivos/upload-arquivos.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="fileUpload[]" multiple>
                    <button type="submit" class="btn btn-padrao btn-success">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cria-pasta" tabindex="-1" role="dialog" aria-labelledby="cria-pasta" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title label-cadastro">Criar Pasta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/navegador-arquivos/cria-pasta.php" method="POST" autocomplete="off">
                    <input name="diretorio_atual" value="<?=$diretorioAtual?>" hidden>
                    <label class="text-secondary"><strong>Nome:</strong></label>
                    <input class="form-control" type="text" name="nome_pasta" autocomplete="off">
                    <div class="mt-2 text-right">
                        <button type="sumit" class="btn btn-padrao btn-success">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleta-arquivo" tabindex="-1" role="dialog" aria-labelledby="deleta-arquivo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary">Deletar Arquivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text text-danger">Tem certeza que deseja deletar?</h5>
                <div class="text-right mt-2">
                    <button id="confirma-del" class="btn btn-padrao btn-danger">Deletar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    function apagaArquivo(caminho){
        var modal = $('#deleta-arquivo').modal();
        $('#confirma-del').click(function(){
            modal.modal("toggle");
            location.assign(caminho);
        });
    }
</script>
