<?php
use App\DAO\EmpresaDAO;
use App\DAO\ClienteDAO;
use App\DAO\GuiaDAO;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new EmpresaDAO();
$clienteDao = new ClienteDAO();

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
$quantidadeOsPendentes = $os->getQuantidadeAll($_SESSION['id_usuario'], 'PENDENTE', $_SESSION['dataCompetencia']);
$pendenciasCredenciamento = $os->getOsUsuarioTipoAll($_SESSION['id_usuario'], 1, 'PENDENTE', $_SESSION['dataCompetencia']);
// $pendenciasFaturamento = $os->getOsPendentesPorTipo($_SESSION['id_usuario'], 2);
$pendenciasCertidao = $os->getOsUsuarioTipoAll($_SESSION['id_usuario'], 3, 'PENDENTE', $_SESSION['dataCompetencia']);
$pendenciasRecalculoGuia = $os->getOsUsuarioTipoAll($_SESSION['id_usuario'], 4, 'PENDENTE', $_SESSION['dataCompetencia']);
$pendenciasDeclaracaoRendimento = $os->getOsUsuarioTipoAll($_SESSION['id_usuario'], 7, 'PENDENTE', $_SESSION['dataCompetencia']);

$empresasSn = $dao->getQuantidadeDeEmpresas('SN');
$totalEmpresaSn = $empresasSn['quantidade'];

$empresasPresumido = $dao->getQuantidadeDeEmpresas('Presumido');
$totalEmpresaPresumido = $empresasPresumido['quantidade'];

if (strtotime($dataCompetencia) <= strtotime('2018-11-01')) {
    $totalEmpresas = $dao->getQuantidadeTotalDeEmpresasNaoCongeladas();
    $quantidadeTotalEmpresasNaoCongeladas = $totalEmpresas['quantidade'];
} else {
    $totalEmpresas = $dao->getQuantidadeEmpresasLiberadas($dataCompetencia);
    $quantidadeTotalEmpresasNaoCongeladas = $totalEmpresas['quantidade'];
}

$dao = new GuiaDAO();

// **************************** GUIAS EMPRESAS **************************** //

$guiasIrrfCadastradas = $dao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('IRRF', $dataCompetencia);
$contadorGuiasIrrf = $quantidadeTotalEmpresasNaoCongeladas - $guiasIrrfCadastradas['quantidade'];
$classGuiaIrrf = ($contadorGuiasIrrf == 0) ? 'text-success' : 'text-danger';

$guiasInssCadastradas = $dao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('INSS', $dataCompetencia);
$contadorGuiasInss = $quantidadeTotalEmpresasNaoCongeladas - $guiasInssCadastradas['quantidade'];
$classGuiaInss = ($contadorGuiasInss == 0) ? 'text-success' : 'text-danger';

$guiasFgtsCadastradas = $dao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('FGTS', $dataCompetencia);

$contadorGuiasFgts = $dao->getQuantidadeFgtsPendente($dataCompetencia);
$classGuiaFgts = ($contadorGuiasFgts == 0) ? 'text-success' : 'text-danger';

// $guiasHoleriteCadastradas = $dao->getFuncionarioMesCompetencia('HOLERITE', $dataCompetencia);
// $guiasHoleriteFaltaCadastro = count($guiasHoleriteCadastradas);
// $classGuiaHolerite = ($guiasHoleriteFaltaCadastro == 0) ? 'text-success' : 'text-danger';

$quantidadeGuiasPendentes = $contadorGuiasIrrf + $contadorGuiasInss + $contadorGuiasFgts;

// **************************** GUIAS DOMESTICAS **************************** //

$guiasHonorarioDomesticasFaltaCadastro = $clienteDao->getQuantidadeGuiaPendenteDomesticas('HONORARIO');
$classGuiaHonorarioDomesticas = ($guiasHonorarioDomesticasFaltaCadastro[0]['quantidade'] == 0) ? 'text-success' : 'text-danger';

$guiasReciboDomesticasFaltaCadastro = $clienteDao->getQuantidadeGuiaPendenteDomesticas('RECIBO');
$classGuiaReciboDomesticas = ($guiasReciboDomesticasFaltaCadastro[0]['quantidade'] == 0) ? 'text-success' : 'text-danger';

$guiasRelatorioDomesticasFaltaCadastro = $clienteDao->getQuantidadeGuiaPendenteDomesticas('RELATORIO');
$classGuiaRelatorioDomesticas = ($guiasRelatorioDomesticasFaltaCadastro[0]['quantidade'] == 0) ? 'text-success' : 'text-danger';

$guiasPagamentoDomesticasFaltaCadastro = $clienteDao->getQuantidadeGuiaPendenteDomesticas('PAGAMENTO');
$classGuiaPagamentoDomesticas = ($guiasPagamentoDomesticasFaltaCadastro[0]['quantidade'] == 0) ? 'text-success' : 'text-danger';

$quantidadeGuiasPendentesDomesticas = $guiasHonorarioDomesticasFaltaCadastro[0]['quantidade'] +
    $guiasReciboDomesticasFaltaCadastro[0]['quantidade'] +
    $guiasRelatorioDomesticasFaltaCadastro[0]['quantidade'] +
    $guiasPagamentoDomesticasFaltaCadastro[0]['quantidade'];
?>

<?= Mensagem::getMensagem($_COOKIE, 'upload_guia', 'mensagem_upload_guia'); ?>

<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="social-box widget-div">
            <h5 class="titulo-widget">Total</h5>
            <i class="fas fa-hotel icone-widget"></i>
            <h5 class="titulo-widget-rodape">Empresas</h5>
            <ul>
                <li>
                    <strong>SN</strong>
                    <span><?= $totalEmpresaSn ?></span>
                </li>
                <li>
                    <strong>Presumido</strong>
                    <span><?= $totalEmpresaPresumido ?></span>
                </li>
            </ul>
        </div>
    </div>

    <!-- VIEW DATA -->
    <div class="col-lg-4 col-md-4">
        <form class="needs-validation-loading" action="index.php" method="get" novalidate>
            <div class="social-box widget-data-div">
                <div class="widget-calendar-div">
                    <h5 class="titulo-widget-calendar"><strong>Data Competência: </strong></h5>
                        <i class="fas fa-calendar icone-widget-calendar"></i>
                    <h5 class="titulo-widget-calendar-rodape"><span> <?= $dataCompetenciaView ?></span></h5>
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
                    <button type="submit" class="btn btn-success btn-padrao font-weight-bold mt-2">Confirmar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-4 col-lg-4">
        <div class="card <?= ($quantidadeOsPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?> text-light">
            <div class="card-body">
                <div class="h4 m-0"><?= $quantidadeOsPendentes ?></div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <h6 class="text-light font-weight-bold">Ordens de Serviços Pendentes</h6>
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
</div>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="card <?= ($quantidadeGuiasPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?> text-light">
            <div class="card-body">
                <div class="h4 m-0"><?= $quantidadeGuiasPendentes ?></div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <h6 class="text-light font-weight-bold">Guias de Empresas Pendentes</h6>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body border-0 p-1 mb-0">
                    <a href="lista-guia.php?tipo=IRRF" class="text-secondary font-weight-bold p-2 gif-loading">
                        IRRF <span class="badge <?= ($contadorGuiasIrrf == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasIrrf ?></span>
                    </a>
                    <a href="lista-guia.php?tipo=INSS" class="text-secondary font-weight-bold p-2 gif-loading">
                        INSS <span class="badge <?= ($contadorGuiasInss == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasInss ?></span>
                    </a>
                    <a href="lista-fgts.php?tipo=FGTS" class="text-secondary font-weight-bold p-2 gif-loading">
                        FGTS <span class="badge <?= ($contadorGuiasFgts == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $contadorGuiasFgts ?></span>
                    </a>
                    <!-- <a href="lista-holerite.php?tipo=HOLERITE" class="text-secondary font-weight-bold p-2 gif-loading">
                        HOLERITE <span class="badge text-white"></span>
                    </a> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="card <?= ($quantidadeGuiasPendentesDomesticas == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?> text-light">
            <div class="card-body">
                <div class="h4 m-0"><?= $quantidadeGuiasPendentesDomesticas ?></div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <h6 class="text-light font-weight-bold">Guias de Domésticas Pendentes</h6>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body border-0 p-1 mb-0">
                    <a href="lista-guia-domestica.php?tipo=HONORARIO" class="text-secondary font-weight-bold p-2 gif-loading">
                        HONORÁRIO <span class="badge <?= ($guiasHonorarioDomesticasFaltaCadastro[0]['quantidade'] == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $guiasHonorarioDomesticasFaltaCadastro[0]['quantidade'] ?></span>
                    </a>
                    <a href="lista-guia-domestica.php?tipo=RECIBO" class="text-secondary font-weight-bold p-2 gif-loading">
                        RECIBO <span class="badge <?= ($guiasReciboDomesticasFaltaCadastro[0]['quantidade'] == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $guiasReciboDomesticasFaltaCadastro[0]['quantidade'] ?></span>
                    </a>
                    <a href="lista-guia-domestica.php?tipo=RELATORIO" class="text-secondary font-weight-bold p-2 gif-loading">
                        RELATÓRIO <span class="badge <?= ($guiasRelatorioDomesticasFaltaCadastro[0]['quantidade'] == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $guiasRelatorioDomesticasFaltaCadastro[0]['quantidade'] ?></span>
                    </a>
                    <a href="lista-guia-domestica.php?tipo=PAGAMENTO" class="text-secondary font-weight-bold p-2 gif-loading">
                        PAGAMENTO <span class="badge <?= ($guiasPagamentoDomesticasFaltaCadastro[0]['quantidade'] == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $guiasPagamentoDomesticasFaltaCadastro[0]['quantidade'] ?></span>
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