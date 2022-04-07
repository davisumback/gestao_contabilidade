<?php
use App\DAO\ClienteDAO;
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastrar Email :)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$cliente = new \App\Model\Usuario\Cliente();
$clientes = $cliente->getClientesSemEmail();
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'inserecaoEmail', 'mensagemInsercaoEmail');?>

    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Área para cadastro do Email dos clientes
        </div>
        <div class="card-body">
            <div class="table-responsive my-2">
                <table id="myTable" class="table">
                    <thead class="table-success">
                        <tr class="label-cadastro">
                            <th scope="col">Empresa</th>                   
                            <th scope="col">Nome</th>
                            <th scope="col">Sexo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="texto-table">
                        <?php foreach ($clientes as $cliente) : ?>
                            <tr>
                                <td><?=$cliente['nome_empresa']?></td>
                                <td><?=$cliente['nome_completo']?></td>
                                <td><?=$cliente['sexo']?></td>
                                <td>
                                    <button data-id-cliente="<?=$cliente['clientesId']?>" data-toggle="modal" data-target="#inserePis" class="btn btn-success btn-padrao btn-sm font-weight-bold">Cadastrar</button>
                                </td>
                            </tr>
                        <?php endforeach ?>                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/cliente/insere-email.php'; ?>

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

    $('#inserePis').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var clientesId = button.data('id-cliente') // Extract info from data-* attributes

        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#clientesId').val(clientesId)
    });
</script>