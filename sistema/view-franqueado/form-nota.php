<?php
use App\DAO\NotaDAO;
use App\Helper\Helpers;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Lista de das minhas notas ;)");
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');
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
                            <button data-toggle="modal" data-target="#nova-nota" class="btn btn-cor-primaria btn-padrao" type="submit">Nova Nota</button>
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
                                class="btn btn-info btn-padrao btn-sm btn-edita-usuario">
                                    Editar
                            </button>
                            <button
                                data-toggle="modal"
                                data-target="#deleta-nota"
                                data-id-nota="<?=$nota['id']?>"
                                data-pasta="<?=$_SESSION['pasta']?>"
                                type="button"
                                class="btn btn-danger btn-padrao btn-sm btn-edita-usuario">
                                    Deletar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>

    <div class="modal fade" id="nova-nota" tabindex="-1" role="dialog" aria-labelledby="nova-nota" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Nova Nota</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/nota/insere-nota.php" method="POST" class="needs-validation-loading" novalidate autocomplete="off">
            			<input name="pasta" value="<?=$_SESSION['pasta']?>" hidden>
            			<input name="id_usuario" value="<?=$_SESSION['id_usuario']?>" hidden>

            			<div class="row">
            				<div class="col-md-12 mb-3">
            					<label for="titulo" class="label-cadastro">Título da Nota</label>
            					<input name="titulo" type="text" class="label-cadastro form-control" id="titulo" required>
            					<div class="invalid-feedback">
            						Digite um título válido para a nota.
            					</div>
            				</div>
            			</div>

            			<div class="row">
            				<div class="col-md-12 mb-3">
            					<label for="texto-nota" class="label-cadastro">Conteúdo</label>
            					<textarea name="texto" class="form-control" id="texto-nota" rows="6" required></textarea>
            					<div class="invalid-feedback">
            						Digite uma descrição para a nota válida.
            					</div>
            				</div>
            			</div>
            			<div class="row">
            				<div class="col-md-12 mb-3">
            					<label for="texto-nota" class="label-cadastro">Data de retorno</label>
            					<input name="data_retorno" type="date" class="label-cadastro form-control" id="titulo">
            				</div>
            			</div>

                        <div class="modal-footer mt-5">
                            <button class="btn btn-cadastrar" type="submit">Cadastrar</button>
                        </div>
            		</form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="altera-nota" tabindex="-1" role="dialog" aria-labelledby="altera-nota" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Editar Anotação</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/nota/altera-nota.php" method="POST" class="needs-validation-loading" novalidate autocomplete="off">
                        <input name="pasta" value="<?=$_SESSION['pasta']?>" hidden>
                        <input name="id_usuario" value="<?=$_SESSION['id_usuario']?>" hidden>
                        <input name="id" id="altera-id" hidden>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="titulo" class="label-cadastro">Título da Nota</label>
                                <input name="titulo" type="text" class="label-cadastro form-control" id="altera-titulo" required>
                                <div class="invalid-feedback">
                                    Digite um título válido para a nota.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="texto-nota" class="label-cadastro">Conteúdo</label>
                                <textarea name="texto" class="form-control" id="altera-texto" rows="6" required></textarea>
                                <div class="invalid-feedback">
                                    Digite uma descrição para a nota válida.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="texto-nota" class="label-cadastro">Data de retorno</label>
                                <input name="data_retorno" type="date" class="label-cadastro form-control" id="altera-retorno">
                            </div>
                        </div>

                        <div class="modal-footer mt-5">
                            <button class="btn btn-secondary btn-padrao" type="submit">Alterar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleta-nota" tabindex="-1" role="dialog" aria-labelledby="deleta-nota" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary">Deletar Anotação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text text-danger">Tem certeza que deseja deletar?</h5>
                    <div class="text-right mt-2">
                        <form id="form-deleta-nota" class="needs-validation-loading d-inline-block" action="../controllers/nota/deleta-nota.php" method="post">
                            <input name="id" id="id-deleta-nota" hidden>
                            <input name="pasta" id="pasta" hidden>
                            <button type="submit" class="btn btn-danger btn-edita-usuario">Deletar</button>
                        </form>
                    </div>
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
    })

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
    })

</script>
