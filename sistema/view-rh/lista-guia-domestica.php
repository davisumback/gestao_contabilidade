<?php
// use App\DAO\EmpresaDAO;
use App\DAO\ClienteDAO;
use App\DAO\GuiaDAO;
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao($_GET['tipo'] . ' ;)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$tipoGuia = $_GET['tipo'];

$guiaDao = new GuiaDAO();
$guiasEnviadasDomesticas = $guiaDao->getGuiasEnviadasDomesticas($tipoGuia);

$botaoEnviadas = "<a href=\"lista-guia-domestica.php?tipo=$tipoGuia\" class=\"btn btn-danger btn-padrao gif-loading\">Ver UPLOAD faltando</a>";
$corStatusGuias = '';
$corTitulo = 'text-success';

$titulo = "Domésticas que já finalizaram o envio de guias de <strong class=\"label-cadastro\">$tipoGuia</strong>.";

if (! array_key_exists('enviadas', $_GET)) {
    // $botaoEnviadas = "<a href=\"lista-guia-domestica.php?tipo=$tipoGuia&enviadas=1\" class=\"btn btn-success btn-padrao gif-loading\">Ver UPLOAD feitos</a>";
    $corStatusGuias = 'text-danger';
    $corTitulo = 'text-danger';
    // $tipoGuiaView = ($tipoGuia == 'HONORARIOS') ? 'HONORÁRIOS' : $tipoGuia;
    $titulo = "Domésticas que ainda estão pendentes de upload da guia de <strong class=\"label-cadastro\">$tipoGuia</strong>.";
   
    $domesticasPendentes = $guiaDao->getDomestiasGuiaPendente($tipoGuia);
}
?>

<?=Mensagem::getMensagem($_COOKIE, 'upload_guia', 'mensagem_upload_guia');?>

<?php if(empty($domesticasPendentes)) : ?>
    <div class="alert alert-light text-center py-3 <?=$corTitulo?>" role="alert">
        <?=$titulo?>
    </div>

    <div class="text-right mb-4">
        <?= $botaoEnviadas; ?>
    </div>
<?php else : ?>
    <div class="alert alert-light text-center py-3 <?=$corTitulo?>" role="alert">
        <?=$titulo?>
    </div>
    
    <?php if (!array_key_exists('enviadas', $_GET)) : ?>
        <div class="table-responsive mb-5">
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">
                    <tr class="table-success">
                        <th scope="col">Id</th>
                        <th scope="col">Número</th>
                        <th scope="col">Nome</th>
                    </tr>
                </thead>
                <tbody class="label-cadastro <?=$corStatusGuias?>">
                    <?php foreach ($domesticasPendentes as $domestica) : ?>
                        <?php $caminho = 'domesticas-guias.php?domestica_id='.$domestica['id'].'&domestica_nome='.$domestica['nome'].'&domestica_cpf='.$domestica['cpf'];?>

                        <tr style="cursor:pointer" onclick="vaiParaNovaPagina('<?=$caminho?>')">
                            <td>
                                <?=$domestica['id']?>
                                <input name="domestica-id" value="<?=$domestica['id']?>" hidden>
                            </td>
                            <td>
                                <?=$domestica['cpf']?>
                                <input name="domestica-cpf" value="<?=$domestica['cpf']?>" hidden>
                            </td>
                            <td>
                                <?=$domestica['nome']?>
                                <input name="domestica-nome" value="<?=$domestica['nome']?>" hidden>
                            </td>
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
                    <?php foreach ($domesticasPendentes as $domestica) : ?>
                        <tr>
                            <td><?=$domestica['id']?></td>
                            <td><?=$domestica['nome_empresa']?></td>                        
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
    });
</script>
