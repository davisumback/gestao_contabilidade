<?php
use App\DAO\NotaDAO;
use App\Helper\Helpers;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Lista de das minhas notas ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');
require_once('../../vendor/autoload.php');

$nota_dao = new NotaDAO();

if(array_key_exists('hoje', $_GET) && $_GET['hoje'] == '1'){
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('Y-m-d');
    $nota_array = $nota_dao->getTodasNotasData($data);
    $mensagemSemAnotacao = 'Você não possui anotações cadastradas para hoje!';
    $botaoNovaNota = '';
}else{
    $nota_array = $nota_dao->getNotas($_SESSION['id_usuario']);
    $mensagemSemAnotacao = 'Você não possui anotações cadastradas :(';
    $botaoNovaNota = '  <div class="text-right mb-3">
                            <button data-toggle="modal" data-target="#nova-nota" class="btn btn-success btn-padrao font-weight-bold" type="submit">Nova Nota</button>
                        </div>';
}
?>

<div id="carregando" class="center display-none">
    <div class="loading">
    </div>
</div>

<div class="row" id="conteudo">
    <div class="col-md-12">
        <div class="text-center mb-3">
            <?=Mensagem::getMensagem($_COOKIE, 'deleta_nota', 'mensagem_deleta');?>
        </div>

        <div class="text-center mb-3">
            <?=Mensagem::getMensagem($_COOKIE, 'insersao_nota', 'mensagem_insercao');?>
        </div>

        <?php if(empty($nota_array)) : ?>
            <div class="alert alert-info mt-3 text-center" role="alert">
                <h6 class="alert-heading"><?=$mensagemSemAnotacao?></h6>
            </div>
            <?=$botaoNovaNota?>
        <?php else : ?>
            <?=$botaoNovaNota?>
            <?php foreach ($nota_array as $nota) : ?>
                <?php
                    date_default_timezone_set('America/Sao_Paulo');
                    $data_atual = date('Y-m-d');
                    $cor_nota = "bg-flat-color-2";
                    if($nota['data_retorno'] == $data_atual){
                        $cor_nota = "bg-anotacao-prioridade";
                    }else if($nota['data_retorno'] < $data_atual && $nota['data_retorno'] != null){
                        $cor_nota = "bg-anotacao-atrasada";
                    }else if($nota['data_retorno'] == null){
                        $cor_nota = "bg-flat-color-2";
                    }
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card text-light card-anotacao <?=$cor_nota?>" >
                        <div class="card-body">
                            <small class="text-light">Criada: <?=Helpers::formataDataView($nota['data_criacao'])?></small>
                            <small class="text-light"> | Retorno: <?=($nota['data_retorno'] == null)? "" : Helpers::formataDataView($nota['data_retorno'])?></small>
                            <div class="h4 m-0"><?=$nota['titulo']?></div>
                            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div>
                                <?php
                                    if(strlen($nota['texto']) > 200 ) {
                                        echo substr($nota['texto'],0,200).'...';
                                    }else {
                                        echo $nota['texto'];
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="text-center mb-2">
                            <button
                                data-toggle="modal"
                                data-target="#altera-nota"
                                data-id-nota="<?=$nota['id']?>"
                                data-titulo-nota="<?=$nota['titulo']?>"
                                data-texto-nota="<?=$nota['texto']?>"
                                data-retorno-nota="<?=$nota['data_retorno']?>"
                                type="button"
                                class="btn btn-secondary btn-sm btn-edita-usuario font-weight-bold">
                                    Editar
                            </button>
                            <button
                                data-toggle="modal"
                                data-target="#deleta-nota"
                                data-id-nota="<?=$nota['id']?>"
                                data-pasta="<?=$_SESSION['pasta']?>"
                                type="button"
                                class="btn btn-danger btn-sm btn-edita-usuario font-weight-bold">
                                    Deletar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>   
</div>

<?php include __DIR__ . '/../modal/anotacoes/nova-nota.php'; ?>
<?php include __DIR__ . '/../modal/anotacoes/editar-nota.php'; ?>
<?php include __DIR__ . '/../modal/anotacoes/deletar-nota.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#deleta-nota').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id-nota') // Extract info from data-* attributes
        var pasta = button.data('pasta') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#id-deleta-nota').val(id)
        modal.find('#pasta').val(pasta)
    });
    $('#altera-nota').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id-nota') // Extract info from data-* attributes
        var titulo = button.data('titulo-nota') // Extract info from data-* attributes
        var texto = button.data('texto-nota') // Extract info from data-* attributes
        var retorno = button.data('retorno-nota') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#altera-id').val(id)
        modal.find('#altera-titulo').val(titulo)
        modal.find('#altera-texto').val(texto)
        modal.find('#altera-retorno').val(retorno)
    });
</script>
