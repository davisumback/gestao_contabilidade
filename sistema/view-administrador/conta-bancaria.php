<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastrar Conta Bancária :)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$arquivoRetorno = 'conta-bancaria.php';

$empresasContaBancaria = new \App\Model\Empresa\EmpresaContaBancaria();
$empresas = $empresasContaBancaria->getEmpresasSemConta();
$bancos = $empresasContaBancaria->getBancos();
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'resultadoInsercaoConta', 'mensagemInsercaoConta');?>

    <div class="card">
        <div class="card-header bg-success text-white font-weight-bold text-center">
            Área para cadastro de Conta Bancária das empresas.
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table id="myTable" class="table">
                    <thead class="table-success label-cadastro">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome da Empresa</th>
                            <th scope="col"></th>
                            <!-- <th scope="col">PIS</th> -->
                        </tr>
                    </thead>
                    <tbody class="texto-table">
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr>
                                <td><?=$empresa['id']?></td>
                                <td><?=$empresa['nome_empresa']?></td>
                                <td>
                                    <button
                                        data-id-empresa="<?=$empresa['id']?>"
                                        data-toggle="modal" data-target="#insere-conta-bancaria"
                                        class="btn btn-success btn-sm btn-edita-usuario font-weight-bold">
                                            Cadastrar
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

<?php include __DIR__ . '/../modal/empresa/conta-bancaria/insere.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable( {
            language: {
                search:         "Pesquisar",
                lengthMenu:     "Mostrar _MENU_ Clientes",
                infoPostFix:    "",
                info:           "Mostrando _START_ de _END_ do total de _TOTAL_ clientes",
                loadingRecords: "Carregando...",
                zeroRecords:    "Nenhum dado encontrado",
                emptyTable:     "Nenhuma dado encontrado",
                paginate: {
                    first:      "Primeiro",
                    previous:   "Anterior",
                    next:       "Próximo",
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": ativar para classificar a coluna em ordem crescente",
                    sortDescending: ": ativar para classificar a coluna em ordem decrescente"
                }
            }
        });
    });

    $('#insere-conta-bancaria').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var empresasId = button.data('id-empresa') // Extract info from data-* attributes

        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#empresas-id').val(empresasId)
    });
</script>

<script src="../assets/custom-js/autocomplete.js"></script>

<script>
    var bancos = [];
    <?php foreach ($bancos as $banco) : ?>
        bancos.push('<?=$banco['nome'] . ' - ' . $banco['cod']?>');
    <?php endforeach ?>
    autocomplete(document.getElementById("input-banco"), bancos);
</script>
