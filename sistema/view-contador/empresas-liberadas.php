<?php
use App\DAO\EmpresaDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Empresas Liberadas :)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$empresaDao = new EmpresaDAO();
$empresasLiberadas = $empresaDao->getEmpresasLiberadasAll();

?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive mb-5">
            <table id="myTable" class="table">
                <thead class="label-cadastro">
                    <tr class="table-success">
                        <th scope="col">Número</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data Competência</th>
                        <th scope="col">Prolabore</th>
                    </tr>
                </thead>
                <tbody class="label-cadastro <?= $corStatusGuias ?>">
                    <?php foreach ($empresasLiberadas as $empresa) : ?>
                        
                        <tr>
                            <td><?= $empresa['id']?></td>
                            <td><?= $empresa['nome_empresa']?></td>
                            <td><?=Helpers::formataDataCompetenciaView($empresa['data_competencia'])?></td>
                            <td><?=Helpers::formataMoedaView($empresa['prolabore'])?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
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
                lengthMenu:     "Mostrar _MENU_ Empresas",
                infoPostFix:    "",
                info:           "Mostrando _START_ de _END_ do total de _TOTAL_ empresas",
                loadingRecords: "Carregando...",
                zeroRecords:    "Nenhuma empresa encontrada",
                emptyTable:     "Nenhuma empresa cadastrada",
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
</script>
