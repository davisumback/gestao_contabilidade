<?php
use App\DAO\IesDAO;
use App\Model\Ies;
use App\Helper\Mensagem;
use App\Arquivo\NavegadorArquivos;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastrar Instituição de Ensino Superior ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$ies = new \App\Model\Ies();
$iesArray = $ies->getAll();
?>

<div id="carregando" class="center" hidden>
    <div class="loading">
    </div>
</div>

<div class="container" id="conteudo">
    <div class="text-center mb-1">
        <?=Mensagem::getMensagem($_COOKIE, 'insercaoIes', 'mensangemInsercaoIes');?>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Área para edição de todas as IES do nosso sistema
        </div>
        <div class="card-body">
            <div class="text-right mb-3">
                <button data-toggle="modal" data-target="#nova-ies" class="btn btn-success btn-padrao font-weight-bold" type="submit">Nova IES</button>
            </div>    
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-success label-cadastro">
                        <tr>
                            <th scope="col">IES</th>
                            <th scope="col">Cidade</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="texto-table">
                        <?php foreach ($iesArray as $ies) : ?>
                            <tr>
                                <td><?=$ies['nome']?></td>
                                <td><?=$ies['cidade']?></td>                                
                                <td class="text-center">
                                    <button                                        
                                        data-toggle="modal"
                                        data-target="#alteraIes"
                                        data-id-ies="<?=$ies['id']?>"
                                        data-nome-ies="<?=$ies['nome']?>"
                                        data-cidade-ies="<?=$ies['cidade']?>"
                                        type="button"
                                        class="btn btn-padrao btn-warning btn-sm font-weight-bold">
                                            Editar
                                    </button>
                                    <button
                                        data-toggle="modal"
                                        data-target="#deleta-ies"
                                        data-id-ies="<?=$ies['id']?>"
                                        type="button"
                                        class="btn btn-padrao btn-danger btn-sm font-weight-bold">
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
</div>

<?php include __DIR__ . '/../modal/ies/insere.php'; ?>
<?php include __DIR__ . '/../modal/ies/edita.php';  ?>
<?php include __DIR__ . '/../modal/ies/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#deleta-ies').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id-ies')
        var modal = $(this)
        modal.find('#id-deleta-ies').val(id)
    })

    $('#alteraIes').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id-ies')
        var nome = button.data('nome-ies')
        var cidade = button.data('cidade-ies')

        var modal = $(this)

        modal.find('#id-ies').val(id)
        modal.find('#altera-nome-ies').val(nome)
        modal.find('#altera-cidade-ies').val(cidade)
    })
</script>