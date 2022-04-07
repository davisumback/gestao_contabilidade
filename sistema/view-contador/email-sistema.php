<?php

use App\DAO\EmpresaGuiaEmailDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Emails enviados pelo Sistema =)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$dataCompetenciaInicial = null;

if (array_key_exists('data_competencia', $_GET)) {
    $dataCompetenciaInicial = $_GET['data_competencia'];
    $dataCompetencia = '01/' . $dataCompetenciaInicial;
    $dataCompetencia = str_replace('/', '-', $dataCompetencia);
    $dataCompetencia = Helpers::formataDataBd($dataCompetencia);
    $dao = new EmpresaGuiaEmailDAO();
    $empresas = $dao->getEmpresasEmails($dataCompetencia);
}
?>

<div class="container-fluid">
    <div class="text-right">
        <form action="../../script/guias/script-email.php" class="needs-validation-loading" method="post" novalidate>
            <input name="envio_forcado" value="true" hidden>
            <input name="data_competencia" value="<?=$dataCompetenciaInicial?>" hidden>

            <!-- <button type="submit" class="btn btn-padrao btn-warning">Forçar Envio</button> -->
        </form>
    </div>

    <div class="text-center">
        <form id="form" action="email-sistema.php" class="needs-validation-loading" method="get" novalidate autocomplete="none">
            <div class="row">
                <div class="col-md-3 col-sm-12 mx-auto">
                    <label class="label-cadastro mr-3">Data Comptência</label>
                    <input autocomplete="off" type="text" name="data_competencia" placeholder="MM/AAAA" class="form-control text-center" id="data-competencia">
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-12">
            <?php if(!empty($empresas)) : ?>
                <div class="table-responsive mb-5">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead class="label-cadastro">
                            <tr class="table-success">
                                <th scope="col">Número</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Data Competência</th>
                                <th scope="col">Enviado</th>
                            </tr>
                        </thead>
                        <tbody class="text-success">
                            <?php foreach ($empresas as $empresa) : ?>
                                <tr>
                                    <td><?=$empresa['empresas_id']?></td>
                                    <td><?=$empresa['nome_empresa']?></td>
                                    <td><?=Helpers::formataDataCompletaView($empresa['data_hora'])?></td>
                                    <td><?=Helpers::formataDataCompetencia($empresa['data_competencia'])?></td>
                                    <td><?=($empresa['email_enviado']) ? 'Sim' : 'Não'?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif (empty($empresas) && array_key_exists('data_competencia', $_GET)) : ?>
                <div class="alert alert-success text-center pt-4 pb-4" role="alert">
                    Não foram enviados emails na competência de <strong><?=$_GET['data_competencia']?></strong>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>
<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    var competencia = document.getElementById("data-competencia");
    competencia.addEventListener("keyup", function() {
        if(competencia.value.length == 7) {
            mostraGifLoading();
            $('#form').submit();
        }
    });

    $('#data-competencia').mask('00/0000');
</script>

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
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    } );
</script>