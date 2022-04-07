<?php
use App\DAO\EmpresaDAO;
use App\DAO\GuiaDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new EmpresaDAO();
$totalEmpresa = $dao->getQuantidadeTotalDeEmpresasPorRegime('SN');
$totalEmpresasSn = $totalEmpresa['quantidade'];
$totalEmpresa = $dao->getQuantidadeTotalDeEmpresasPorRegime('Presumido');
$totalEmpresasPresumido = $totalEmpresa['quantidade'];

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

$os = new \App\Model\Os\OrdemDeServico;
$quantidadeOsPendentes = $os->getQuantidadeAllSemData($_SESSION['id_usuario'], 'PENDENTE');
$pendenciasCredenciamento = $os->getOsUsuarioTipoAllSemData($_SESSION['id_usuario'], 1, 'PENDENTE');
// $pendenciasFaturamento = $os->getOsPendentesPorTipo($_SESSION['id_usuario'], 2);
$pendenciasCertidao = $os->getOsUsuarioTipoAllSemData($_SESSION['id_usuario'], 3, 'PENDENTE');
$pendenciasRecalculoGuia = $os->getOsUsuarioTipoAllSemData($_SESSION['id_usuario'], 4, 'PENDENTE');
$pendenciasDeclaracaoRendimento = $os->getOsUsuarioTipoAllSemData($_SESSION['id_usuario'], 7, 'PENDENTE');

$competenciaAtual = \App\Helper\Helpers::formataDataPeriodo('add', $dataCompetencia, 'P1M', 'm/Y');

$retorno = $dao->getQuantidadeEmpresaNaoCongeladas('SN');
$quantidadeEmpresasSn = $retorno['quantidade'];

$empresasPresumido = $dao->getQuantidadeEmpresaNaoCongeladas('Presumido');
$quantidadeEmpresasPresumido = $empresasPresumido['quantidade'];

if (strtotime($dataCompetencia) <= strtotime('2018-11-01')) {
    $totalEmpresas = $dao->getQuantidadeTotalDeEmpresasNaoCongeladas();
    $quantidadeEmpresasLiberadas = $totalEmpresas['quantidade'];
} else {
    $totalEmpresas = $dao->getQuantidadeEmpresasLiberadas($dataCompetencia);
    $quantidadeEmpresasLiberadas = $totalEmpresas['quantidade'];
}

$quantidadeTotalEmpresasNaoCongeladas = $quantidadeEmpresasPresumido + $quantidadeEmpresasSn;

$guiaDao = new GuiaDAO();
$guiasHonorariosCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('HONORARIOS', $dataCompetencia);
$contadorGuiasHonorarios = $quantidadeTotalEmpresasNaoCongeladas - $guiasHonorariosCadastradas['quantidade'];
$classGuiaHonorarios = ($contadorGuiasHonorarios == 0) ? 'text-success' : 'text-danger';

$guiasDasCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('DAS', $dataCompetencia);
$contadorGuiasDas = $quantidadeEmpresasSn - $guiasDasCadastradas['quantidade'];
$classGuiaDas = ($contadorGuiasDas == 0) ? 'text-success' : 'text-danger';

$guiasIrrfCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('IRRF', $dataCompetencia);
$contadorGuiasIrrf = $quantidadeEmpresasLiberadas - $guiasIrrfCadastradas['quantidade'];
$classGuiaIrrf = ($contadorGuiasIrrf == 0) ? 'text-success' : 'text-danger';

$guiasInssCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('INSS', $dataCompetencia);
$contadorGuiasInss = $quantidadeEmpresasLiberadas - $guiasInssCadastradas['quantidade'];
$classGuiaInss = ($contadorGuiasInss == 0) ? 'text-success' : 'text-danger';

$guiasFgtsCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('FGTS', $dataCompetencia);
$contadorGuiasFgts = $quantidadeEmpresasLiberadas - $guiasFgtsCadastradas['quantidade'];
$classGuiaFgts = ($contadorGuiasFgts == 0) ? 'text-success' : 'text-danger';

$guiasPisCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('PIS', $dataCompetencia);
$contadorGuiasPis = $quantidadeEmpresasPresumido - $guiasPisCadastradas['quantidade'];
$classGuiaPis = ($contadorGuiasPis == 0) ? 'text-success' : 'text-danger';

$guiasCofinsCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('COFINS', $dataCompetencia);
$contadorGuiasCofins = $quantidadeEmpresasPresumido - $guiasCofinsCadastradas['quantidade'];
$classGuiaCofins = ($contadorGuiasCofins == 0) ? 'text-success' : 'text-danger';

$guiasIrpjCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('IRPJ', $dataCompetencia);
$contadorGuiasIrpj = $quantidadeEmpresasPresumido - $guiasIrpjCadastradas['quantidade'];
$classGuiaIrpj = ($contadorGuiasIrpj == 0) ? 'text-success' : 'text-danger';

$guiasCsllCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('CSLL', $dataCompetencia);
$contadorGuiasCsll = $quantidadeEmpresasPresumido - $guiasCsllCadastradas['quantidade'];
$classGuiaCsll = ($contadorGuiasCsll == 0) ? 'text-success' : 'text-danger';

$guiasIssCadastradas = $guiaDao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('ISS', $dataCompetencia);
$contadorGuiasIss = $quantidadeEmpresasPresumido - $guiasIssCadastradas['quantidade'];
$classGuiaIss = ($contadorGuiasIss == 0) ? 'text-success' : 'text-danger';
?>

<div class="row">
    <!-- VIEW DATA -->
    <div class="col-md-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form class="mb-0" id="form" action="../controllers/empresa/pesquisa-empresa.php" method="post" autocomplete="off" novalidate>
                            <input name="pasta" value="<?= $_SESSION['pasta'] ?>" hidden>
                            <div class="row text-center">
                                <div class="mb-3 mx-auto label-cadastro">
                                    <label for="numero-empresa">Pesquisar Empresa</label>
                                    <input id="numero-empresa" class="text-center form-control" type="text" name="numero_empresa" required autocomplete="none">
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="mx-auto label-cadastro">
                                    <button type="submit" class="btn btn-padrao btn-info btn-sm font-weight-bold">Pesquisar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form class="needs-validation-loading" action="index.php" method="get" novalidate>
                    <div class="social-box widget-data-div">
                        <div class="widget-calendar-div">
                            <h6 class="titulo-widget-calendar"><strong>Data Competência: </strong></h6>
                            <!-- <i class="fas fa-calendar icone-widget-calendar"></i> -->
                            <h6 class="titulo-widget-calendar-rodape pt-2">
                                <span><?=$dataCompetenciaView?></span>
                            </h6>
                        </div>
                        <ul>
                            <li style="border-right:0px;">
                                <strong class="titulo-total-empresas text-center">MÊS</strong>
                                <label class="label-cadastro" for="mes"></label>
                                <select name="competenciaMes" class="form-control mx-auto text-center" id="mes" required style="color: #949CA0;   background-clip: #949CA0 ;">
                                    <option value="">Escolha...</option>
                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                    <option>
                                        <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
                                    </option>
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
                                    <?php endif?>
                                    <option <?=$selecionado?> value="<?=$i?>">
                                        <?=$i?>
                                    </option>
                                    <?php $selecionado = ''; ?>
                                    <?php endfor ?>
                                </select>
                            </li>
                        </ul>
                        <div class="text-center pb-2">
                            <button type="submit" class="btn btn-success btn-padrao btn-sm font-weight-bold mt-2">Confirmar</button>
                        </div>
                    </div>
                </form>            
            </div>
        </div>        
    </div>

    <div class="col-md-4">
        <?php $totalGuiasPendentes = $contadorGuiasDas + $contadorGuiasPis + $contadorGuiasCofins + $contadorGuiasIrpj + $contadorGuiasCsll + $contadorGuiasIss; ?>
        <div class="card <?= ($totalGuiasPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?> text-light">
            <div class="card-body">
                <div class="h5 m-0"><?= $totalGuiasPendentes ?></div>
                <div class="progress-bar bg-light my-2" role="progressbar" style="width: 20%; height: 5px;"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <h6 class="text-light font-weight-bold">Guias Pendentes</h6>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body border-0 p-1 mb-0">
                    <a href="lista-guia.php?tipo=HONORARIO" class="text-secondary font-weight-bold p-1 gif-loading">
                        HONORÁRIOS <span class="badge <?= ($contadorGuiasHonorarios == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasHonorarios?></span>
                    </a>
                    <a href="lista-guia.php?tipo=IRRF" class="text-secondary font-weight-bold p-1 gif-loading">
                        IRRF <span class="badge <?= ($contadorGuiasIrrf == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasIrrf?></span>
                    </a>
                    <a href="lista-guia.php?tipo=INSS" class="text-secondary font-weight-bold p-1 gif-loading">
                        INSS <span class="badge <?= ($contadorGuiasInss == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasInss?></span>
                    </a>
                    <a href="lista-guia.php?tipo=FGTS" class="text-secondary font-weight-bold p-1 gif-loading">
                        FGTS <span class="badge <?= ($contadorGuiasFgts == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasFgts?></span>
                    </a>
                    <a href="lista-guia.php?tipo=DAS" class="text-secondary font-weight-bold p-1 gif-loading">
                        DAS <span class="badge <?= ($contadorGuiasDas == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasDas?></span>
                    </a>
                    <a href="lista-guia.php?tipo=PIS" class="text-secondary font-weight-bold p-1 gif-loading">
                        PIS <span class="badge <?= ($contadorGuiasPis == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasPis?></span>
                    </a>
                    <a href="lista-guia.php?tipo=COFINS" class="text-secondary font-weight-bold p-1 gif-loading">
                        COFINS <span class="badge <?= ($contadorGuiasCofins == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasCofins?></span>
                    </a>
                    <a href="lista-guia.php?tipo=IRPJ" class="text-secondary font-weight-bold p-1 gif-loading">
                        IRPJ <span class="badge <?= ($contadorGuiasIrpj == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasIrpj?></span>
                    </a>
                    <a href="lista-guia.php?tipo=CSLL" class="text-secondary font-weight-bold p-1 gif-loading">
                        CSLL <span class="badge <?= ($contadorGuiasCsll == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasCsll?></span>
                    </a>
                    <a href="lista-guia.php?tipo=ISS" class="text-secondary font-weight-bold p-1 gif-loading">
                        ISS <span class="badge <?= ($contadorGuiasIss == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?=$contadorGuiasIss?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="card <?=($quantidadeOsPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-red'?> text-light">
            <div class="card-body">
                <div class="h5 m-0"><?=$quantidadeOsPendentes?></div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <h6 class="text-light font-weight-bold">Ordem de Serviços Pendentes</h6>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body border-0 p-1 mb-0">
                    <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=1" class="text-secondary font-weight-bold px-1 gif-loading">
                        Credenciamento <span class="badge <?=($pendenciasCredenciamento == 0) ? 'bg-cor-accent-primaria' : 'bg-danger'?> text-white"><?=$pendenciasCredenciamento?></span>
                    </a>
                    <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=3" class="text-secondary font-weight-bold px-1 gif-loading">
                        Emissão de Certidão <span class="badge <?=($pendenciasCertidao == 0) ? 'bg-cor-accent-primaria' : 'bg-danger'?> text-white"><?=$pendenciasCertidao?></span>
                    </a>
                    <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=4" class="text-secondary font-weight-bold px-1 gif-loading">
                        Recálculo de Guias <span class="badge <?=($pendenciasRecalculoGuia == 0) ? 'bg-cor-accent-primaria' : 'bg-danger'?> text-white"><?=$pendenciasRecalculoGuia?></span>
                    </a>
                    <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=7" class="text-secondary font-weight-bold px-1 gif-loading">
                        Declaração de Rendimento <span class="badge <?=($pendenciasDeclaracaoRendimento == 0) ? 'bg-cor-accent-primaria' : 'bg-danger'?> text-white"><?=$pendenciasDeclaracaoRendimento?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>