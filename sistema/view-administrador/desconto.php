<?php
use App\Model\Grupob\Desconto;
use App\Helper\Mensagem;
use App\Arquivo\NavegadorArquivos;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Descontos :)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$desconto = new \App\Model\Grupob\Desconto();
$descontos = $desconto->getAll();
?>

<div class="container" id="conteudo">
    <?=Mensagem::getMensagem($_COOKIE, 'insercaoDescontos', 'mensangemInsercaoDescontos');?>
    
    <?php if (empty($descontos)) : ?>
        <div class="alert alert-light text-center pt-4 pb-4" role="alert">
            <strong class="text-danger">Não há descontos cadastrados.</strong>
        </div>
    <?php else : ?>    
        <div class="card">
            <div class="card-header bg-success text-white text-center font-weight-bold">
                Área para cadastro de Descontos
            </div>
            <div class="card-body">
                <div class="text-right mb-3">
                    <button data-toggle="modal" data-target="#novo-desconto" class="btn btn-success font-weight-bold btn-padrao" type="submit">Novo Desconto</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-success label-cadastro">
                            <tr>
                                <th scope="col">Desconto</th>
                                <th scope="col">Valor</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="texto-table">
                            <?php foreach ($descontos as $desconto) : ?>
                                <tr>
                                    <td><?=$desconto['nome']?></td>
                                    <td>R$ <?=Helpers::formataMoedaView($desconto['valor'])?></td>                                
                                    <td class="text-center">
                                        <button                                        
                                            data-toggle="modal"
                                            data-target="#alteraDesconto"
                                            data-id-desconto="<?=$desconto['id']?>"
                                            data-nome-desconto="<?=$desconto['nome']?>"
                                            data-valor-desconto="<?=$desconto['valor']?>"
                                            type="button"
                                            class="btn btn-padrao btn-warning btn-sm font-weight-bold">
                                                Editar
                                        </button>
                                        <button
                                            data-toggle="modal"
                                            data-target="#deleta-desconto"
                                            data-id-desconto="<?=$desconto['id']?>"
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
    <?php endif ?>
</div>

<?php include __DIR__ . '/../modal/desconto/insere.php'; ?>
<?php include __DIR__ . '/../modal/desconto/edita.php';  ?>
<?php include __DIR__ . '/../modal/desconto/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#deleta-desconto').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id-desconto')
        var modal = $(this)
        modal.find('#id-deleta-desconto').val(id)
    })

    $('#alteraDesconto').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id-desconto')
        var nome = button.data('nome-desconto')
        var valor = button.data('valor-desconto')

        var modal = $(this)

        modal.find('#id-desconto').val(id)
        modal.find('#altera-nome-desconto').val(nome)
        modal.find('#altera-valor-desconto').val(valor)
    })
</script>

<script type="text/javascript">
    $('#valor-desconto').mask('000.000.000,00', {reverse: true});
    $('#altera-valor-desconto').mask('000.000.000,00', {reverse: true});
</script>