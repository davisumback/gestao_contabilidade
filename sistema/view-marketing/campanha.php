<?php
use App\Model\Campanha;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Campanhas :)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$campanha = new App\Model\Campanha();
$dados = $campanha->getDadosClienteCampanha();
?>

<div class="container">
    <div class="card">
        <div class="card-header bg-success text-center text-white font-weight-bold">
            Aqui você consegue ver os dados da campanha <strong>Outback</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive my-2">
                <table id="myTable" class="table table-bordered table-hover">
                    <thead class="label-cadastro">                   
                        <tr class="table-success">
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">CRM</th>
                            <th scope="col">UF</th>
                            <th scope="col">IES</th>
                            <th scope="col">Ano Formação</th>
                            <th scope="col">Especialidade</th>
                            <th scope="col">Conteúdo Relacionado</th>
                            <th scope="col">Conclusão Residência</th>
                            <th scope="col">Facebook</th>
                            <th scope="col">Instagram</th>
                            <th scope="col">Linkedin</th>
                            <th scope="col">Twitter</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Youtube</th>
                            <th scope="col">Outros</th>           
                        </tr>
                    </thead>
                    <tbody class="label-cadastro">
                        <?php foreach ($dados as $dado) : ?>
                            <tr>
                                <td><?=$dado['nome_completo']?></td>
                                <td><?=Helpers::mask($dado['cpf'], '###.###.###-##')?></td>
                                <td><?=$dado['crm']?></td>
                                <td><?=$dado['estado']?></td>
                                <td><?=$dado['instituicao_ensino']?></td>
                                <td><?=Helpers::formataDataView($dado['ano_formacao'])?></td>
                                <td><?=$dado['especialidade']?></td>
                                <td><?=$dado['conteudos_relacionados']?></td>
                                <td><?=Helpers::formataDataView($dado['conclusao_residencia'])?></td>
                                <td><?=$dado['facebook']?></td>
                                <td><?=$dado['instagram']?></td>
                                <td><?=$dado['linkedin']?></td>
                                <td><?=$dado['twitter']?></td>
                                <td><?=$dado['whatsapp']?></td>
                                <td><?=$dado['youtube']?></td>
                                <td><?=$dado['outros']?></td>
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
