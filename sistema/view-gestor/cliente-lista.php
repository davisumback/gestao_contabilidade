<?php
use App\Model\Cliente;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Nossos clientes :)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$cliente = new Cliente();
$clientes = $cliente->getAll();
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Lista de todos nossos Clientes
        </div>
        <div class="card-body">
            <div class="table-responsive my-2">
                <table id="myTable" class="table table-bordered table-hover">
                    <thead class="label-cadastro">                   
                        <tr class="table-success">
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody class="label-cadastro">
                        <?php foreach ($clientes as $cliente) : ?>
                            <tr>
                                <td><?=$cliente['nome_completo']?></td>
                                <td><?=Helpers::mask($cliente['cpf'], '###.###.###-##')?></td>
                                <td><?=Helpers::mask($cliente['telefone_celular'], '(##) #####-####')?></td>
                                <td><?=$cliente['email']?></td>
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
                emptyTable:     "Nenhum dado encontrado",
                paginate: {
                    first:      "Primeiro",
                    previous:   "Anterior",
                    next:       "Próximo",
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    });
</script>