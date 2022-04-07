<?php
use App\DAO\ClienteDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Direcionamento Imposto de Renda :)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new ClienteDAO();
$clientes = $dao->getDirecionamentoImpostoRenda();
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            View do Direcionamento
        </div>
        <div class="card-body">
            <div class="table-responsive my-2">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead class="label-cadastro">
                        <tr>
                            <th scope="col">Empresa</th>
                            <th scope="col">Nome</th>                   
                            <th scope="col">CPF</th>                   
                        </tr>
                    </thead>
                    <tbody class="texto-table text-success">
                        <?php foreach ($clientes as $cliente) : ?>
                            <tr>
                                <td><?=$cliente['empresas_id']?></td>
                                <td><?=$cliente['nome_completo']?></td>
                                <td><?= Helpers::mask($cliente['cpf'], '###.###.###-##')  ?></td>
                            </tr>
                        <?php endforeach ?>                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
    } );
</script>