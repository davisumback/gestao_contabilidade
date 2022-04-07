<?php
use App\Model\Marketing\Newsletter;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Newsletter :)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$newsletter = new Newsletter();
$newsletter = $newsletter->getAll();
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white font-weight-bold text-center">
            Lista de todos nossos contatos newsletter :)
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table id="myTable" class="table table-bordered table-hover">
                    <thead class="label-cadastro">                   
                        <tr class="table-success">
                            <th scope="col">Email</th>
                            <th scope="col">Data Assinatura</th>
                        </tr>
                    </thead>
                    <tbody class="label-cadastro">
                        <?php foreach ($newsletter as $newsletter) : ?>
                            <tr>
                                <td class="text-nowrap"><?=$newsletter['email']?></td>
                                <td class="text-nowrap"><?=Helpers::formataDataView($newsletter['created_at'])?></td>
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