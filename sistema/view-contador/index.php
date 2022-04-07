<?php
use App\DAO\EmpresaDAO;
use App\DAO\GuiaDAO;
use App\DAO\GuiaDataPadraoDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

$empresaDao = new EmpresaDAO();
$dataCompetencia = $_SESSION['dataCompetencia'];
$dataCompetenciaView = $_SESSION['dataCompetenciaView'];

if (array_key_exists('competenciaMes', $_GET) && array_key_exists('competenciaAno', $_GET)) {
    $mes = $_GET['competenciaMes'];
    $ano = $_GET['competenciaAno'];

    $dataCompetencia = $ano . '-' . $mes . '-' . $_SESSION['diaPadraoCompetencia'];
    $_SESSION['dataCompetencia'] = $dataCompetencia;

    $dataCompetenciaView = $mes . '/' . $ano;
    $_SESSION['dataCompetenciaView'] = $dataCompetenciaView;
}

// $os = new \App\Model\Os\OrdemDeServico;
// $quantidadeOsPendentes = $os->getQuantidadeAll($_SESSION['id_usuario'], 'PENDENTE', $_SESSION['dataCompetencia']);
// $pendenciasCredenciamento = $os->getOsUsuarioTipoAll($_SESSION['id_usuario'], 1, 'PENDENTE', $_SESSION['dataCompetencia']);
// // $pendenciasFaturamento = $os->getOsPendentesPorTipo($_SESSION['id_usuario'], 2);
// $pendenciasCertidao = $os->getOsUsuarioTipoAll($_SESSION['id_usuario'], 3, 'PENDENTE', $_SESSION['dataCompetencia']);
// $pendenciasRecalculoGuia = $os->getOsUsuarioTipoAll($_SESSION['id_usuario'], 4, 'PENDENTE', $_SESSION['dataCompetencia']);
// $pendenciasDeclaracaoRendimento = $os->getOsUsuarioTipoAll($_SESSION['id_usuario'], 7, 'PENDENTE', $_SESSION['dataCompetencia']);

$liberacoesPendentes = $empresaDao->getQuantidadeLiberacoesPendentes($dataCompetencia, $_SESSION['id_usuario']);
$liberacoesPendentes = $liberacoesPendentes['quantidade'];
$statusLiberacoes = ($liberacoesPendentes > 0) ? 'bg-red' : 'bg-green';

$retorno = $empresaDao->getQuantidadeDeEmpresasPorContadorPorRegime($_SESSION['id_usuario'], 'SN');
$totalEmpresasSn = $retorno['quantidade'];

$retorno = $empresaDao->getQuantidadeDeEmpresasPorContadorPorRegime($_SESSION['id_usuario'], 'Presumido');
$totalEmpresasPresumido = $retorno['quantidade'];

$retorno = $empresaDao->getQuantidadeDeEmpresasPorContadorPorRegimeNaoCongelada($_SESSION['id_usuario'], 'SN');
$quantidadeEmpresasSn = $retorno['quantidade'];

$retorno = $empresaDao->getQuantidadeDeEmpresasPorContadorPorRegimeNaoCongelada($_SESSION['id_usuario'], 'Presumido');
$quantidadeEmpresasPresumido = $retorno['quantidade'];

$guiaDao = new GuiaDAO();
$das = $guiaDao->getQuantidadeGuiaPendenteMesContador($_SESSION['id_usuario'], 'DAS', 'SN', $dataCompetencia);
$das = $das['quantidade'];
$contadorGuiasDas = $quantidadeEmpresasSn - $das;
$classGuiaDas = ($contadorGuiasDas == 0) ? 'text-success' : 'text-danger';

$pis = $guiaDao->getQuantidadeGuiaPendenteMesContador($_SESSION['id_usuario'], 'PIS', 'Presumido', $dataCompetencia);
$pis = $pis['quantidade'];
$contadorGuiasPis = $quantidadeEmpresasPresumido - $pis;
$classGuiaPis = ($contadorGuiasPis == 0) ? 'text-success' : 'text-danger';

$cofins = $guiaDao->getQuantidadeGuiaPendenteMesContador($_SESSION['id_usuario'], 'COFINS', 'Presumido', $dataCompetencia);
$cofins = $cofins['quantidade'];
$contadorGuiasCofins = $quantidadeEmpresasPresumido - $cofins;
$classGuiaCofins = ($contadorGuiasCofins == 0) ? 'text-success' : 'text-danger';

$irpj = $guiaDao->getQuantidadeGuiaPendenteMesContador($_SESSION['id_usuario'], 'IRPJ', 'Presumido', $dataCompetencia);
$irpj = $irpj['quantidade'];
$contadorGuiasIrpj = $quantidadeEmpresasPresumido - $irpj;
$classGuiaIrpj = ($contadorGuiasIrpj == 0) ? 'text-success' : 'text-danger';

$csll = $guiaDao->getQuantidadeGuiaPendenteMesContador($_SESSION['id_usuario'], 'CSLL', 'Presumido', $dataCompetencia);
$csll = $csll['quantidade'];
$contadorGuiasCsll = $quantidadeEmpresasPresumido - $csll;
$classGuiaCsll = ($contadorGuiasCsll == 0) ? 'text-success' : 'text-danger';

$iss = $guiaDao->getQuantidadeGuiaPendenteMesContador($_SESSION['id_usuario'], 'ISS', 'Presumido', $dataCompetencia);
$iss = $iss['quantidade'];
$contadorGuiasIss = $quantidadeEmpresasPresumido - $iss;

$dao = new GuiaDataPadraoDAO();
$dasDatas = $dao->getDataPadraoGuia('DAS');
$pisDatas = $dao->getDataPadraoGuia('PIS');
$cofinsDatas = $dao->getDataPadraoGuia('COFINS');
$irpjDatas = $dao->getDataPadraoGuia('IRPJ');
$csllDatas = $dao->getDataPadraoGuia('CSLL');
$issDatas = $dao->getDataPadraoGuia('ISS');
?>

<div class="row">
    <!-- <div class="col-lg-4 col-md-6">
        <div class="social-box widget-div">
            <h5 class="titulo-widget">Total</h5>
            <i class="fas fa-hotel icone-widget"></i>
            <h5 class="titulo-widget-rodape">Empresas</h5>
            <ul>
                <li>
                    <strong>SN</strong>
                    <span><?= $totalEmpresasSn ?></span>
                </li>
                <li>
                    <strong>Presumido</strong>
                    <span><?= $totalEmpresasPresumido ?></span>
                </li>
            </ul>
        </div>
    </div> -->

    <!-- VIEW DATA -->
    <div class="col-md-4">
        <form class="needs-validation-loading" action="index.php" method="get" novalidate>
            <div class="social-box widget-data-div">
                <div class="widget-calendar-div">
                    <h5 class="titulo-widget-calendar"><strong>Data Competência: </strong></h5>
                        <!-- <i class="fas fa-calendar icone-widget-calendar"></i> -->
                    <h5 class="titulo-widget-calendar-rodape pt-3"><span> <?= $dataCompetenciaView ?></span></h5>
                </div>
                <ul>
                    <li style="border-right:0px;">
                        <strong class="titulo-total-empresas text-center">MÊS</strong>
                        <label class="label-cadastro" for="mes"></label>
                        <select name="competenciaMes" class="form-control mx-auto text-center" id="mes" required style="color: #949CA0;   background-clip: #949CA0 ;">
                            <option value="">Escolha...</option>
                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <option><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                            <?php endfor ?>
                        </select>
                    </li>
                    <li>
                        <strong class="titulo-total-empresas text-center">ANO</strong>
                        <label class="label-cadastro" for="mes"></label>
                        <select name="competenciaAno" class="form-control mx-auto text-center" id="ano" required style="color: #949CA0;   background-clip: #949CA0;">
                            <?php $selecionado = ''; ?>
                            <?php for ($i = 2018; $i <= 2030; $i++) : ?>
                                <?php if ($i == 2019) : ?>
                                    <?php $selecionado = 'selected="true"'; ?>
                                <?php endif ?>
                                <option <?= $selecionado ?> value="<?= $i ?>"><?= $i ?></option>
                                <?php $selecionado = ''; ?>
                            <?php endfor ?>
                        </select>
                    </li>
                </ul>
                <div class="text-center" style="padding: 10px;">
                    <button type="submit" class="btn btn-success btn-sm font-weight-bold btn-padrao mt-2">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <?php 
        $totalGuiasPendentes = $contadorGuiasDas + $contadorGuiasPis + $contadorGuiasCofins + $contadorGuiasIrpj + $contadorGuiasCsll + $contadorGuiasIss;
        ?>
        <div class="card <?= ($totalGuiasPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?> text-light">
            <div class="card-body">
                <div class="h4 m-0"><?= $totalGuiasPendentes ?></div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <h6 class="text-light font-weight-bold">Guias Pendentes</h6>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body border-0 p-1 mb-0">
                    <a href="lista-guia.php?tipo=DAS" class="text-secondary font-weight-bold p-2 gif-loading">
                        DAS <span class="badge <?= ($contadorGuiasDas == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasDas ?></span>
                    </a>
                    <a href="lista-guia.php?tipo=PIS" class="text-secondary font-weight-bold p-2 gif-loading">
                        PIS <span class="badge <?= ($contadorGuiasPis == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasPis ?></span>
                    </a>
                    <a href="lista-guia.php?tipo=COFINS" class="text-secondary font-weight-bold p-2 gif-loading">
                        COFINS <span class="badge <?= ($contadorGuiasCofins == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasCofins ?></span>
                    </a>
                    <a href="lista-guia.php?tipo=IRPJ" class="text-secondary font-weight-bold p-2 gif-loading">
                        IRPJ <span class="badge <?= ($contadorGuiasIrpj == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasIrpj ?></span>
                    </a>
                    <a href="lista-guia.php?tipo=CSLL" class="text-secondary font-weight-bold p-2 gif-loading">
                        CSLL <span class="badge <?= ($contadorGuiasCsll == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasCsll ?></span>
                    </a>
                    <a href="lista-guia.php?tipo=ISS" class="text-secondary font-weight-bold p-2 gif-loading">
                        ISS <span class="badge <?= ($contadorGuiasIss == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasIss ?></span>
                    </a>
                    <div class="row mt-3">
                        <div class="col-12 text-center mb-3">
                            <button
                                data-toggle="modal"
                                data-target="#guia-datas-contador"
                                data-das-vencimento="<?= $dasDatas['dia_vencimento'] ?>"
                                data-pis-vencimento="<?= $pisDatas['dia_vencimento'] ?>"
                                data-cofins-vencimento="<?= $cofinsDatas['dia_vencimento'] ?>"
                                data-irpj-vencimento="<?= $irpjDatas['dia_vencimento'] ?>"
                                data-csll-vencimento="<?= $csllDatas['dia_vencimento'] ?>"
                                type="button"
                                class="btn btn-secondary btn-sm btn-padrao font-weight-bold">
                                    Datas Guias
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card <?= $statusLiberacoes ?> text-light card-button" onclick="vaiParaNovaPagina('lista-liberacoes.php')">
            <div class="card-body">
                <div class="h4 m-0"><?= $liberacoesPendentes ?></div>
                <div>Empresas</div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <small class="text-light">Aguardando liberação</small>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="card <?= ($quantidadeOsPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?> text-light">
            <div class="card-body">
                <div class="h4 m-0"><?= $quantidadeOsPendentes ?></div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <h6 class="text-light font-weight-bold">Ordem de Serviços Pendentes</h6>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body border-0 p-1 mb-0">
                    <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=1" class="text-secondary font-weight-bold p-2 gif-loading">
                        Credenciamento <span class="badge <?= ($pendenciasCredenciamento == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $pendenciasCredenciamento ?></span>
                    </a>
                    <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=3" class="text-secondary font-weight-bold p-2 gif-loading">
                        Emissão de Certidão <span class="badge <?= ($pendenciasCertidao == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $pendenciasCertidao ?></span>
                    </a>
                    <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=4" class="text-secondary font-weight-bold p-2 gif-loading">
                        Recálculo de Guias <span class="badge <?= ($pendenciasRecalculoGuia == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $pendenciasRecalculoGuia ?></span>
                    </a>
                    <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=7" class="text-secondary font-weight-bold p-2 gif-loading">
                        Declaração de Rendimento <span class="badge <?= ($pendenciasDeclaracaoRendimento == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $pendenciasDeclaracaoRendimento ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> -->

<?php
include __DIR__ . '/../modal/guia-datas-contador.php';

require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#guia-datas-contador').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);

        var dasVencimento = button.data('das-vencimento');
        var pisVencimento = button.data('pis-vencimento');
        var irpjVencimento = button.data('irpj-vencimento');
        var csllVencimento = button.data('csll-vencimento');
        var cofinsVencimento = button.data('cofins-vencimento');

        var modal = $(this)
        modal.find('#das-vencimento').val(dasVencimento)
        modal.find('#pis-vencimento').val(pisVencimento)
        modal.find('#cofins-vencimento').val(cofinsVencimento)
        modal.find('#irpj-vencimento').val(irpjVencimento)
        modal.find('#csll-vencimento').val(csllVencimento)
    });
</script>

<script type="text/javascript">
    $('#das-vencimento').mask('00');
    $('#pis-vencimento').mask('00');
    $('#cofins-vencimento').mask('00');
</script>
