<?php
use App\DAO\EmpresaDAO;
use App\DAO\GuiaDAO;
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao($_GET['tipo'] . ' ;)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$tipoGuia = $_GET['tipo'];
$dataCompetencia = $_SESSION['dataCompetencia'];
$dataCompetenciaView = $_SESSION['dataCompetenciaView'];

$guiaDao = new GuiaDAO();
$empresas = $guiaDao->getGuiasEnviadas($tipoGuia, $dataCompetencia);

$botaoEnviadas = "<a href=\"lista-guia.php?tipo=$tipoGuia\" class=\"btn btn-danger btn-padrao gif-loading\">Ver UPLOAD faltando</a>";
$corStatusGuias = '';
$corTitulo = 'text-success';
$titulo = "Empresas que já finalizaram o envio de guias de <strong class=\"label-cadastro\">$tipoGuia</strong> na competência <strong class=\"label-cadastro\">$dataCompetenciaView</strong>.";

if (!array_key_exists('enviadas', $_GET)) {
    $botaoEnviadas = "<a href=\"lista-guia.php?tipo=$tipoGuia&enviadas=1\" class=\"btn btn-success btn-padrao gif-loading\">Ver UPLOAD feitos</a>";
    $corStatusGuias = 'text-danger';
    $corTitulo = 'text-danger';
    $tipoGuiaView = ($tipoGuia == 'HONORARIOS') ? 'HONORÁRIOS' : $tipoGuia;
    $titulo = "Empresas que ainda estão pendentes de upload da guia de <strong class=\"label-cadastro\">$tipoGuiaView</strong> na competência <strong class=\"label-cadastro\">$dataCompetenciaView</strong>.";

    $guiasSN = ['DAS'];
    $guiasPresumido = ['PIS', 'COFINS', 'IRPJ', 'CSLL', 'ISS'];

    $dao = new EmpresaDAO();
    $empresas = $dao->getNomeTodasEmpresasNaoCongeladas();

    if (in_array($tipoGuia, $guiasSN)) {
        $empresas = $dao->getNomeTodasEmpresasNaoCongeladas('SN');
    }

    if (in_array($tipoGuia, $guiasPresumido)) {
        $empresas = $dao->getNomeTodasEmpresasNaoCongeladas('Presumido');
    }

    $empresasGuias = $guiaDao->getGuiasMesCompetencia($tipoGuia, $dataCompetencia);

    foreach ($empresasGuias as $arrayChave => $valor) {
        foreach($empresas as $arrayChaveEmpresa => $valorEmpresa){
            if($valor['id'] == $valorEmpresa['id']){
                unset($empresas[$arrayChaveEmpresa]);
            }
        }
    }
}
?>

<?=Mensagem::getMensagem($_COOKIE, 'upload_guia', 'mensagem_upload_guia');?>

<?php if(empty($empresas)) : ?>
    <div class="alert alert-light text-center pt-4 pb-4 <?=$corTitulo?>" role="alert">
        <?=$titulo?>
    </div>

    <div class="text-right mb-4">
        <?= $botaoEnviadas; ?>
    </div>
<?php else : ?>
    <div class="alert alert-light text-center pt-4 pb-4 <?=$corTitulo?>" role="alert">
        <?=$titulo?>
    </div>

    <div class="text-right mb-4">
        <?= $botaoEnviadas; ?>
    </div>

    <?php if (!array_key_exists('enviadas', $_GET)) : ?>
        <div class="table-responsive mb-5">
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">
                    <tr class="table-success">
                        <th scope="col">Número</th>
                        <th scope="col">Nome</th>
                    </tr>
                </thead>
                <tbody class="label-cadastro <?=$corStatusGuias?>">
                    <?php foreach ($empresas as $empresa) : ?>
                        <tr>
                            <td><?=$empresa['id']?></td>
                            <td><?=$empresa['nome_empresa']?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="table-responsive mb-5">
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">
                    <tr class="table-success">
                        <th scope="col">Número</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Vencimento</th>
                        <th scope="col">Competência</th>
                        <th scope="col">Upload</th>
                        <th scope="col">Guia</th>
                        <th scope="col">Sem Guia</th>
                        <th scope="col">Em Conjunto</th>
                    </tr>
                </thead>
                <tbody class="label-cadastro <?=$corStatusGuias?>">
                    <?php foreach ($empresas as $empresa) : ?>
                        <tr>
                            <td><?=$empresa['id']?></td>
                            <td><?=$empresa['nome_empresa']?></td>
                            <td><?=Helpers::formataDataView($empresa['data_vencimento'])?></td>
                            <td><?=Helpers::formataDataCompetenciaView($empresa['data_competencia'])?></td>
                            <td><?=Helpers::formataDataView($empresa['data_upload'])?></td>
                            <?php
                                if ($empresa['nome_guia'] != '') {
                                    $caminhoBase = '//sistema.grupobcontabil.com.br/grupobfiles/empresas/';
                                    $caminhoBase .= $empresa['id'] . '/impostos/' . Helpers::formataDataCompetenciaUrl($empresa['data_competencia']) . '/' . $empresa['nome_guia'];
                                    $nome = $empresa['nome_guia'];
                                    $saida = "<td style=\"cursor:pointer;\" onclick=\"vaiParaNovaAba('$caminhoBase')\">$nome</td>";
                                }else {
                                    $nome = $empresa['nome_guia'];
                                    $saida = "<td>$nome</td>";
                                }
                                echo $saida;
                            ?>
                            <td><?=($empresa['sem_guia'] == 1) ? 'Sim' : 'Não'?></td>
                            <td><?=($empresa['em_conjunto'] == 1) ? 'Sim' : 'Não'?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
<?php endif ?>

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
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    } );

</script>
