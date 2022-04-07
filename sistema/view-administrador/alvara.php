<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastrar Alvará :)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$empresa = new \App\Model\Empresa\Empresa();
$empresas = $empresa->getEmpresasSemAlvara();
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'insercaoEmpresaController', 'mensagemEmpresaController');?>

    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Área para cadastro de alvará
        </div>
        <div class="card-body">
            <div class="table-responsive my-2">
                <table id="myTable" class="table">
                    <thead class="table-success">
                        <tr class="label-cadastro">
                            <th scope="col">Id</th>
                            <th scope="col">Empresa</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="texto-table">
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr>
                                <td><?=$empresa['id']?></td>
                                <td><?=$empresa['nome_empresa']?></td>
                                <td><button data-id-empresa="<?=$empresa['id']?>" data-toggle="modal" data-target="#insere" class="btn btn-success btn-sm btn-edita-usuario font-weight-bold">Cadastrar</button></td>
                            </tr>
                        <?php endforeach ?>                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/empresa/alvara/insere.php'; ?>

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

    $('#insere').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var empresasId = button.data('id-empresa') // Extract info from data-* attributes

        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#empresasId').val(empresasId)
    });

    $('.input-vencimento').mask('00/00/0000');
</script>