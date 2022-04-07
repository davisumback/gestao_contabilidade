<?php
use App\Arquivo\NavegadorArquivosFranquia;

require_once('header.php');
require_once('menu-topo.php');

$numeroEmpresa = $_SESSION['empresasId'];

$caminhoRaizEmrpesa = '../../grupobfiles/empresas/' . $numeroEmpresa . '/';

if (array_key_exists('dir', $_GET) && ! strpos($_GET['dir'], $numeroEmpresa)) {
    header('Location: index.php');
    die();
}

$menu_topo->setTituloNavegacao('Navegador de Arquivos');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');
?>

<?php
    
    NavegadorArquivosFranquia::setNomeDaPagina('empresa-arquivos.php');
    NavegadorArquivosFranquia::setDiretorioEmpresa($numeroEmpresa);
    NavegadorArquivosFranquia::getCaminhoDiretorioAtual($_GET);
    NavegadorArquivosFranquia::getCaminhoVoltar();
?>

<div class="row mx-0">
    <div class="col-12 text-center">
        <?=NavegadorArquivosFranquia::criaMenuNavegacao();?>
    </div>
</div>

<div class="row mx-0">
    <?=NavegadorArquivosFranquia::criaNavegadorDeArquivos();?>
</div>

<?php
    NavegadorArquivosFranquia::liberaDiretorio();
?>

<?php
    $diretorioAtual = (!array_key_exists('dir', $_GET)) ? $caminhoRaizEmrpesa : $_GET['dir'];
?>

<?php $_SESSION['diretorio_base'] = $diretorioAtual?>

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