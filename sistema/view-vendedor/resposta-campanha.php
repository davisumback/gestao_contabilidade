<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Pessoas que responderam os emails :)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new \App\Model\Marketing\Marketing();
$respostas = $dao->allRespostas();

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive mb-5">
                <table id="myTable" class="table table-bordered table-hover">
                    <thead class="label-cadastro">                   
                        <tr class="table-success">
                            <th scope="col">Nome</th>
                            <th class="text-nowrap" scope="col">Cidade Origem</th>
                            <th class="text-nowrap" scope="col">Ano Formação</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Cidade Palestra</th>
                            <th class="text-nowrap" scope="col">Estado Palestra</th>
                            <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <tbody class="label-cadastro">
                        <?php foreach ($respostas as $resposta) : ?>
                            <tr>
                                <td class="text-nowrap"><?=$resposta['nome_completo']?></td>
                                <td><?=$resposta['cidade_origem']?></td>
                                <td><?=Helpers::formataDataView($resposta['ano_formacao'])?></td>
                                <td class="text-nowrap"><?=Helpers::mask($resposta['telefone'], '(##) #####-####')?></td>
                                <td><?=$resposta['email']?></td>
                                <td class="text-nowrap"><?=$resposta['cidade']?></td>
                                <td class="text-nowrap"><?=$resposta['estado']?></td>
                                <td class="text-nowrap"><?=Helpers::formataDataView($resposta['data_palestra'])?></td>
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
    } );
</script>