<?php
use App\DAO\AdministradorDAO;
use App\DAO\EmpresaDAO;
use App\DAO\GuiaDAO;
use App\DAO\ApiDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new ApiDAO();
$apiCpf = $dao->getApi('cpf');
$apiCnpj = $dao->getApi('cnpj');

$dao = new EmpresaDAO();
$totalEmpresa = $dao->getQuantidadeTotalDeEmpresasPorRegime('SN', 'AND congelada = 0');
$totalEmpresasSn = $totalEmpresa['quantidade'];
$totalEmpresa = $dao->getQuantidadeTotalDeEmpresasPorRegime('Presumido', 'AND congelada = 0');
$totalEmpresasPresumido = $totalEmpresa['quantidade'];

$totalEmpresa = $dao->getQuantidadeTotalDeEmpresasPorRegime('SN', 'AND congelada = 1');
$totalEmpresasSnCongeladas = $totalEmpresa['quantidade'];
$totalEmpresa = $dao->getQuantidadeTotalDeEmpresasPorRegime('Presumido', 'AND congelada = 1');
$totalEmpresasPresumidoCongeladas = $totalEmpresa['quantidade'];

$dataCompetencia = $_SESSION['dataCompetencia'];
$dataCompetenciaView = $_SESSION['dataCompetenciaView'];

$liberacoesPendentes = $dao->getQuantidadeLiberacoesPendentes($dataCompetencia);
$liberacoesPendentes = $liberacoesPendentes['quantidade'];
$statusLiberacoes = ($liberacoesPendentes > 0) ? 'bg-red' : 'bg-green';

if (array_key_exists('competenciaMes', $_GET) && array_key_exists('competenciaAno', $_GET)) {
    $mes = $_GET['competenciaMes'];
    $ano = $_GET['competenciaAno'];

    $dataCompetencia = $ano . '-' . $mes . '-' . $_SESSION['diaPadraoCompetencia'];
    $_SESSION['dataCompetencia'] = $dataCompetencia;

    $dataCompetenciaView = $mes . '/' . $ano;
    $_SESSION['dataCompetenciaView'] = $dataCompetenciaView;
}

$os = new \App\Model\Os\OrdemDeServico;
// $quantidadeOsPendentes = $os->getOsPorStatusAll('PENDENTE', $_SESSION['dataCompetencia']);
$quantidadeOsPendentes = $os->getOsPorStatusAllSemData('PENDENTE');
// $pendenciasCredenciamento = $os->getOsPorTipoAll(1, 'PENDENTE', $_SESSION['dataCompetencia']);
$pendenciasCredenciamento = $os->getQuantidadeAllSemDataSemUsuario(1, 'PENDENTE');
$finalizadasCredenciamento = $os->getOsPorTipoAll(1, 'FINALIZADA', $_SESSION['dataCompetencia']);
// $pendenciasFaturamento = $os->getOsPendentesPorTipo($_SESSION['id_usuario'], 2);
// $pendenciasCertidao = $os->getOsPorTipoAll(3, 'PENDENTE', $_SESSION['dataCompetencia']);
$pendenciasCertidao = $os->getQuantidadeAllSemDataSemUsuario(3, 'PENDENTE');
$finalizadasCertidao = $os->getOsPorTipoAll(3, 'FINALIZADAS', $_SESSION['dataCompetencia']);
// $pendenciasRecalculoGuia = $os->getOsPorTipoAll(4, 'PENDENTE', $_SESSION['dataCompetencia']);
$pendenciasRecalculoGuia = $os->getQuantidadeAllSemDataSemUsuario(4, 'PENDENTE');
$finalizadasRecalculoGuia = $os->getOsPorTipoAll(4, 'FINALIZADAS', $_SESSION['dataCompetencia']);
// $pendenciasDeclaracaoRendimento = $os->getOsPorTipoAll(7, 'PENDENTE', $_SESSION['dataCompetencia']);
$pendenciasDeclaracaoRendimento = $os->getQuantidadeAllSemDataSemUsuario(7, 'PENDENTE');
$finalizadasDeclaracaoRendimento = $os->getOsPorTipoAll(7, 'FINALIZADAS', $_SESSION['dataCompetencia']);

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
    <div class="col-md-3">
        <form class="needs-validation-loading" action="index.php" method="get" novalidate>
            <div class="social-box widget-data-div">
                <div class="widget-calendar-div">
                    <h6 class="titulo-widget-calendar"><strong>Data Competência: </strong></h6>
                    <!-- <i class="fas fa-calendar icone-widget-calendar"></i> -->
                    <h6 class="titulo-widget-calendar-rodape pt-1">
                        <span><?= $dataCompetenciaView ?></span>
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
                                <?php endif ?>
                                <option <?= $selecionado ?> value="<?= $i ?>"><?= $i ?></option>
                                <?php $selecionado = ''; ?>
                            <?php endfor ?>
                        </select>
                    </li>
                </ul>
                <div class="text-center" style="padding: 10px;">
                    <button type="submit" class="btn btn-success btn-padrao btn-sm font-weight-bold">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="social-box widget-div">
            <h6 class="titulo-widget">Total</h6>
            <!-- <i class="fas fa-hotel icone-widget"></i> -->
            <h6 class="titulo-widget-rodape pt-1">Empresas</h6>
            <ul>
                <li class="item-total-empresas text-center">
                    <strong class="titulo-total-empresas">SN</strong>
                    <h6>
                        <?= $totalEmpresasSn ?>
                    </h6>
                    <h6 class="text-danger">
                        <?= $totalEmpresasSnCongeladas ?>
                    </h6>
                </li>
                <li class="item-total-empresas text-center">
                    <strong class="titulo-total-empresas">Presumido</strong>
                    <h6>
                        <?= $totalEmpresasPresumido ?>
                    </h6>
                    <h6 class="text-danger">
                        <?= $totalEmpresasPresumidoCongeladas ?>
                    </h6>
                </li>
                <li class="item-total-empresas text-center item-border-left">
                    <strong class="titulo-total-empresas">Total</strong>
                    <h6>
                        <?= $totalEmpresasSn + $totalEmpresasPresumido ?>
                    </h6>
                    <h6 class="text-danger">
                        <?= $totalEmpresasSnCongeladas + $totalEmpresasPresumidoCongeladas ?>
                    </h6>
                    <h6>
                        <?= $totalEmpresasSnCongeladas + $totalEmpresasPresumidoCongeladas + $totalEmpresasSn + $totalEmpresasPresumido ?>
                    </h6>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-2">
        <div class="social-box widget-cpfcnpj-div">
            <h6 class="titulo-widget-cpfcnpj">Total</h6>
            <!-- <i class="fas fa-rocket icone-widget-cpfcnpj"></i> -->
            <h6 class="titulo-widget-cpfcnpj-rodape pt-1">API</h6>
            <ul class="pt-4">
                <li>
                    <strong class="titulo-total-empresas">CPF</strong>
                    <h6>
                        <?= $apiCpf['requisicoes_restantes'] ?>
                    </h6>
                </li>
                <li>
                    <strong class="titulo-total-empresas">CNPJ</strong>
                    <h6>
                        <?= $apiCnpj['requisicoes_restantes'] ?>
                    </h6>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card <?= $statusLiberacoes ?> text-light card-button" onclick="vaiParaNovaPagina('lista-liberacoes.php')">
            <div class="card-body">
                <div class="h5 m-0">
                    <?= $liberacoesPendentes ?>
                </div>
                <div>Empresas</div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <small class="text-light">Aguardando liberação</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">    
        <div class="social-box widget-cpfcnpj-div">
            <div class="card <?= ($quantidadeOsPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?>  mb-0 text-light">
                <div class="card-body text-left">
                    <div class="h5 m-0">
                        <?= $quantidadeOsPendentes ?>
                    </div>
                    <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    <h6 class="text-light font-weight-bold">Ordem de Serviços Pendentes</h6>
                </div>
            </div>
            <ul>
                <li>
                    <strong class="titulo-total-empresas">PENDENTES</strong>
                    <a href="ordem-servico-lista.php?view=all&tipoOs=1&status=PENDENTE&periodo=30&method=getAll" class="text-secondary font-weight-bold line-height-card-adm gif-loading">
                        Credenciamento
                        <span class="badge <?= ($pendenciasCredenciamento == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $pendenciasCredenciamento ?></span>
                    </a>
                    <a href="ordem-servico-lista.php?view=all&tipoOs=3&status=PENDENTE&periodo=30&method=getAll" class="text-secondary font-weight-bold line-height-card-adm gif-loading text-nowrap">
                        Emissão Certidão
                        <span class="badge <?= ($pendenciasCertidao == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $pendenciasCertidao ?></span>
                    </a>
                    <a href="ordem-servico-lista.php?view=all&tipoOs=4&status=PENDENTE&periodo=30&method=getAll" class="text-secondary font-weight-bold line-height-card-adm gif-loading text-nowrap">
                        Recálculo Guias
                        <span class="badge <?= ($pendenciasRecalculoGuia == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $pendenciasRecalculoGuia ?></span>
                    </a>
                    <a href="ordem-servico-lista.php?view=all&tipoOs=7&status=PENDENTE&periodo=30&method=getAll" class="text-secondary font-weight-bold line-height-card-adm gif-loading text-nowrap">
                        Dec. Rendimento
                        <span class="badge <?= ($pendenciasDeclaracaoRendimento == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $pendenciasDeclaracaoRendimento ?></span>
                    </a>
                </li>
                <li>
                    <strong class="titulo-total-empresas">FINALIZADOS</strong>
                    <a href="ordem-servico-lista.php?view=all&tipoOs=1&status=FINALIZADA&periodo=30&method=getAll" class="text-secondary font-weight-bold line-height-card-adm gif-loading">
                        <span class="badge bg-cor-accent-primaria text-white"><?= $finalizadasCredenciamento ?></span>
                        Credenciamento
                    </a>
                    <a href="ordem-servico-lista.php?view=all&tipoOs=3&status=FINALIZADA&periodo=30&method=getAll" class="text-secondary font-weight-bold line-height-card-adm gif-loading text-nowrap">
                        <span class="badge bg-cor-accent-primaria text-white"><?= $finalizadasCertidao ?></span>
                        Emissão Certidão
                    </a>
                    <a href="ordem-servico-lista.php?view=all&tipoOs=4&status=FINALIZADA&periodo=30&method=getAll" class="text-secondary font-weight-bold line-height-card-adm gif-loading text-nowrap">
                        <span class="badge bg-cor-accent-primaria text-white"><?= $finalizadasRecalculoGuia ?></span>
                        Recálculo Guias
                    </a>
                    <a href="ordem-servico-lista.php?view=all&tipoOs=7&status=FINALIZADA&periodo=30&method=getAll" class="text-secondary font-weight-bold line-height-card-adm gif-loading text-nowrap">
                        <span class="badge bg-cor-accent-primaria text-white"><?= $finalizadasDeclaracaoRendimento ?></span>
                        Dec. Rendimento
                    </a>
                </li>
            </ul>
        </div>    
    </div>
    <div class="col-md-4">
        <?php 
        $totalGuiasPendentes = $contadorGuiasDas + $contadorGuiasPis + $contadorGuiasCofins + $contadorGuiasIrpj + $contadorGuiasCsll + $contadorGuiasIss;
        ?>
        <div class="card <?= ($totalGuiasPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?> text-light">
            <div class="card-body">
                <div class="h5 m-0"><?= $totalGuiasPendentes ?></div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
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
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>