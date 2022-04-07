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

$competenciaAnterior = Helpers::formataDataPeriodo('sub', $dataCompetencia, 'P1M', 'Y-m-d');
$competenciaAnteriorView = Helpers::formataDataPeriodo('sub', $dataCompetencia, 'P1M', 'm/Y');

$guiaDao = new GuiaDAO();
$empresas = $guiaDao->getGuiasEnviadas($tipoGuia, $dataCompetencia);

$botaoEnviadas = "<a href=\"lista-holerite.php?tipo=$tipoGuia\" class=\"btn btn-danger btn-padrao gif-loading\">Ver UPLOAD faltando</a>";
$corStatusGuias = '';
$corTitulo = 'text-success';

$titulo = "Empresas que já finalizaram o envio de guias de <strong class=\"label-cadastro\">$tipoGuia</strong> na competência <strong class=\"label-cadastro\">$dataCompetenciaView</strong>.";

if (! array_key_exists('enviadas', $_GET)) {
    $botaoEnviadas = "<a href=\"lista-holerite.php?tipo=$tipoGuia&enviadas=1\" class=\"btn btn-success btn-padrao gif-loading\">Ver UPLOAD feitos</a>";
    $corStatusGuias = 'text-danger';
    $corTitulo = 'text-danger';
    $tipoGuiaView = ($tipoGuia == 'HONORARIOS') ? 'HONORÁRIOS' : $tipoGuia;
    $titulo = "Empresas que ainda estão pendentes de upload da guia de <strong class=\"label-cadastro\">$tipoGuiaView</strong> na competência <strong class=\"label-cadastro\">$dataCompetenciaView</strong>.";

    $dao = new EmpresaDAO();
    // $empresas = $dao->getNomeTodasEmpresasNaoCongeladas();
    // $empresas = $dao->getEmpresasLiberadas($dataCompetencia);
    // $empresas = $dao->getEmpresasLiberadasNew($competenciaAnterior, $dataCompetencia);
   
    $empresasComFuncionarios = $guiaDao->getFuncionarioMesCompetencia($tipoGuia, $dataCompetencia);
}
?>

<?=Mensagem::getMensagem($_COOKIE, 'upload_guia', 'mensagem_upload_guia');?>

<?php if(empty($empresasComFuncionarios)) : ?>
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
        <a href="../views/pdf/rh/lista-guia.php?tipo=<?=$tipoGuia?>" target="_blank" class="btn btn-padrao btn-info">Gerar PDF</a>
        <?= $botaoEnviadas; ?>
    </div>

    <?php if (!array_key_exists('enviadas', $_GET)) : ?>
        <div class="table-responsive mb-5">
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">
                    <tr class="table-success text-center">
                        <th scope="col" colspan="2" style="border:none!important;background-color:#f1f2f7!important;"></th>
                        
                    </tr>
                    <tr class="table-success">
                        <th scope="col">Número</th>
                        <th scope="col">Nome</th>
                    </tr>
                </thead>
                <tbody class="label-cadastro <?=$corStatusGuias?>">
                    <?php $idAnterior = 0; ?>

                    <?php foreach ($empresasComFuncionarios as $empresa) : ?>
                        <?php $caminho = '../controllers/empresa/perfil-empresa-guia.php?empresas_id='.$empresa['id'];?>

                        <tr style="cursor:pointer" onclick="vaiParaNovaPagina('<?=$caminho?>')">
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
                    <?php foreach ($empresasComFuncionarios as $empresa) : ?>
                        <tr>
                            <td><?=$empresa['id']?></td>
                            <td><?=$empresa['nome_empresa']?></td>                        
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
