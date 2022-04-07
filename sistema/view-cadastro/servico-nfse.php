<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastrar Serviços NFSe ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$servicos = new \App\Model\ServicosNFSe();
$servicos = $servicos->getAll();
?>

<div id="carregando" class="center" hidden>
    <div class="loading">
    </div>
</div>

<div class="container" id="conteudo">
    <div class="text-center mb-2">
        <?=Mensagem::getMensagem($_COOKIE, 'insercaoIes', 'mensangemInsercaoIes');?>
    </div>
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Área para edição de serviços NFSe
        </div>
        <div class="card-body">
            <div class="text-right mb-3">
                <button data-toggle="modal" data-target="#novo-servico" class="btn btn-success btn-padrao font-weight-bold" type="submit">Novo Serviço</button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-success label-cadastro">
                        <tr>
                            <th scope="col">Código Serviço</th>
                            <th scope="col">Nome</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="texto-table">
                        <?php foreach ($servicos as $servico) : ?>
                            <tr>
                                <td><?=$servico['codigo_servico']?></td>
                                <td><?=$servico['nome']?></td>                                
                                <td class="text-center">
                                    <button                                        
                                        data-toggle="modal"
                                        data-target="#alteraServico"
                                        data-id-servico="<?=$servico['id']?>"
                                        data-codigo-servico="<?=$servico['codigo_servico']?>"
                                        data-nome-servico="<?=$servico['nome']?>"
                                        type="button"
                                        class="btn btn-padrao btn-warning btn-sm font-weight-bold">
                                            Editar
                                    </button>
                                    <button
                                        data-toggle="modal"
                                        data-target="#deletaServico"
                                        data-id-servico="<?=$servico['id']?>"
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
</div>

<?php include __DIR__ . '/../modal/servico-nfse/insere.php'; ?>
<?php include __DIR__ . '/../modal/servico-nfse/edita.php';  ?>
<?php include __DIR__ . '/../modal/servico-nfse/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#alteraServico').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id-servico')
        var codServico = button.data('codigo-servico')
        var nome = button.data('nome-servico')

        var modal = $(this)

        modal.find('#servicoId').val(id)
        modal.find('#cod-servico').val(codServico)
        modal.find('#nome').val(nome)
    });

    $('#deletaServico').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id-servico')

        var modal = $(this)

        modal.find('#servicoId').val(id)
    });    

    $(document).ready(function(){
        $('.valor').mask('00.00');
    });
</script>