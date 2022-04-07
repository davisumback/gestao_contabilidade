<?php
require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

use App\DAO\EmpresaDAO;

$dao = new EmpresaDAO();
$empresas = $dao->getNomeTodasEmpresas();
?>

<div class="container-fluid">
    <div class="row justify-content-around">
        <div class="col-8">
            <div class="card">
                <h5 class="card-header bg-cor-accent-primaria text-center">Lista de Empresas</h5>
                <div class="card-body">
                    <div class="table-responsive mx-auto my-2">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="label-cadastro" scope="col">Número</th>
                                    <th class="label-cadastro" scope="col">Nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($empresas as $empresa) :?>
                                    <tr style="cursor:pointer;" class="text-center" onclick="vaiParaPerfilEmpresa('<?=$empresa['id']?>')">
                                        <td class="label-cadastro"><?=$empresa['id']?></td>
                                        <td class="label-cadastro"><?=$empresa['nome_empresa']?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form-perfil-empresa" action="../controllers/empresa/perfil-empresa.php" method="post" hidden>
    </form>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    function vaiParaPerfilEmpresa(id){
        var formEmpresa = document.getElementById("form-perfil-empresa");
        var inputEmpresa = document.createElement("INPUT");
        inputEmpresa.setAttribute("hidden", "true");
        inputEmpresa.setAttribute("name", "empresas_id");
        inputEmpresa.setAttribute("value", id);
        formEmpresa.appendChild(inputEmpresa);
        formEmpresa.submit();
    }

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
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    });
</script>
