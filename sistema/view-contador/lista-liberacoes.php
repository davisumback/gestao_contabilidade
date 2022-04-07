<?php
use App\DAO\EmpresaDAO;
use App\DAO\GuiaDAO;
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Liberações de empresas :)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$empresaDao = new EmpresaDAO();
$dataCompetencia = $_SESSION['dataCompetencia'];
$dataCompetenciaView = $_SESSION['dataCompetenciaView'];

$competenciaAnterior = Helpers::formataDataPeriodo('sub', $dataCompetencia, 'P1M', 'Y-m-d');
$competenciaAnteriorView = Helpers::formataDataPeriodo('sub', $dataCompetencia, 'P1M', 'm/Y');
$empresasPendentes = $empresaDao->getEmpresasLiberacoesPendentes($dataCompetencia, $_SESSION['id_usuario']);
?>

<?=Mensagem::getMensagem($_COOKIE, 'liberacaoEmpresa', 'mensagemLiberacao');?>

<?php if(empty($empresasPendentes)) : ?>
    <div class="alert alert-light text-center pt-4 pb-4 label-cadastro font-weight-bold" role="alert">
        Sem empresas para fazer liberação na competência <span class="label-cadastro"><?=$dataCompetenciaView?>.</span>
    </div>
<?php else : ?>
    <div class="card">
        <div class="card-header bg-success text-center text-white">
            Empresas que precisam de liberação na competência <span class="font-weight-bold"><?=$dataCompetenciaView?>.</span>
        </div>
        <div class="card-body">
            <form class="needs-validation-loading" action="../controllers/empresa/libera-empresa.php" novalidate method="post" autocomplete="off">
                <input name="data_competencia" value="<?=$dataCompetencia?>" hidden>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-padrao font-weight-bold">Enviar</button>
                </div>
                <div class="table-responsive mb-5">
                    <table id="myTable" class="table">
                        <thead class="label-cadastro">
                            <tr class="table-success text-center">
                                <th scope="col" colspan="3" style="border:none!important;background-color:#f1f2f7!important;"></th>
                                <th scope="col" colspan="2">Competência</th>
                            </tr>
                            <tr class="table-success">
                                <th scope="col"></th>
                                <th scope="col">Número</th>
                                <th scope="col">Nome</th>
                                <th scope="col" class="text-center"><?=$competenciaAnteriorView?></th>
                                <th scope="col" class="text-center"><?=$dataCompetenciaView?></th>
                            </tr>
                        </thead>
                        <tbody class="label-cadastro">
                            <?php foreach ($empresasPendentes as $empresa) : ?>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input name="liberacao[<?=$empresa['id']?>]" type="checkbox" class="custom-control-input" id="<?=$empresa['id']?>">
                                            <label class="custom-control-label" for="<?=$empresa['id']?>"></label>
                                        </div>
                                    </th>
                                    <th><?=$empresa['id']?></th>
                                    <th><?=$empresa['nome_empresa']?></th>
                                    <th class="text-center" id="coluna-<?=$empresa['id']?>"></th>
                                    <th class="text-center" id="coluna-<?=$empresa['id']?>-2"></th>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    var empresaObjeto = {};

    $(":checkbox").change(function () {
        if (this.checked == true) {
            criaInputsProlabore(this.id);
        } else {
            removeInputsProlabore(this.id);
        }
    });

    function removeInputsProlabore(id) {
        var inputCompetenciaAnterior = '#valorCompetenciaAnterior-' + id;
        var inputCompetencia = '#valorCompetencia-' + id;
        $(inputCompetenciaAnterior).remove();
        $(inputCompetencia).remove();
    }

    function criaInputsProlabore(id) {
        var colunaCompetenciaAnterior = document.getElementById('coluna-' + id);
        var inputCompetenciaAnterior = document.createElement('INPUT');
        inputCompetenciaAnterior.className = 'form-control text-center';
        inputCompetenciaAnterior.id = "valorCompetenciaAnterior-" + id;

        getProlabore('#valorCompetenciaAnterior-', inputCompetenciaAnterior, id, '<?=$competenciaAnterior?>');

        inputCompetenciaAnterior.setAttribute('required', 'true');
        inputCompetenciaAnterior.setAttribute('name', 'liberacao[' +id+ '][<?=$competenciaAnterior?>]');
        inputCompetenciaAnterior.setAttribute('type', 'text');
        inputCompetenciaAnterior.setAttribute('autocomplete', 'off');

        var colunaCompetencia = document.getElementById('coluna-' + id + '-2');
        var inputCompetencia = document.createElement('INPUT');
        inputCompetencia.className = 'form-control text-center';
        inputCompetencia.id = "valorCompetencia-" + id;

        getProlabore('#valorCompetencia-', inputCompetencia, id, '<?=$dataCompetencia?>');

        inputCompetencia.setAttribute('required', 'true');
        inputCompetencia.setAttribute('name', 'liberacao[' +id+ '][<?=$dataCompetencia?>]');
        inputCompetencia.setAttribute('type', 'text');
        inputCompetencia.setAttribute('autocomplete', 'off');

        colunaCompetenciaAnterior.appendChild(inputCompetenciaAnterior);
        colunaCompetencia.appendChild(inputCompetencia);
    }

    function getProlabore(idMask, input, empresasId, competencia) {
        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "../api/empresa/prolabore.php", true);
        xhttp.setRequestHeader("Content-type", "aplication/json");

        empresaObjeto['empresasId'] = empresasId;
        empresaObjeto['competencia'] = competencia;

        var jsonParaEnviar = JSON.stringify(empresaObjeto);

        xhttp.send(jsonParaEnviar);

        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                objetoProlabore = JSON.parse(this.responseText);

                input.setAttribute('value', '0.00');

                if (objetoProlabore != null) {
                    input.setAttribute('value', objetoProlabore['prolabore']);
                }

                $(idMask+empresasId).mask('00.000,00', {reverse: true});
            }
        }
    }
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
                    sortAscending:  ": ativar para classificar a coluna em ordem crescente",
                    sortDescending: ": ativar para classificar a coluna em ordem decrescente"
                }
            }
        });
    } );

</script>
