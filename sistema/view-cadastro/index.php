<?php
use App\DAO\EmpresaDAO;
use App\DAO\GuiaDAO;
use App\DAO\InconsistenciaDAO;
use App\Helper\Mensagem;

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

$totalEmpresa = $empresaDao->getQuantidadeTotalDeEmpresasPorRegime('SN');
$totalEmpresasSn = $totalEmpresa['quantidade'];
$totalEmpresa = $empresaDao->getQuantidadeTotalDeEmpresasPorRegime('Presumido');
$totalEmpresasPresumido = $totalEmpresa['quantidade'];

$empresaModel = new \App\Model\Empresa\Empresa();
$empresasSemAlvara = $empresaModel->getQtdEmpresasSemAlvara();
$faltaCadastroAlvara = count($empresasSemAlvara);
$classTotalAlvara = ($faltaCadastroAlvara == 0) ? 'text-success' : 'text-danger';

$empresaContaBancaria = new \App\Model\Empresa\EmpresaContaBancaria();
$empresasSemContaBancaria = $empresaContaBancaria->getEmpresasSemConta();
$faltaCadastroContaBancaria = count($empresasSemContaBancaria);
$classTotalContaBancaria = ($faltaCadastroContaBancaria == 0) ? 'text-success' : 'text-danger';

$empresaPis = new \App\DAO\ClienteDAO();
$empresasSemPis = $empresaPis->getAllClienteSemPis();
$faltaCadastroPis = count($empresasSemPis);
$classTotalPis = ($faltaCadastroPis == 0) ? 'text-success' : 'text-danger';

$empresaInscMunicipal = new \App\Model\Empresa\Empresa();
$empresasSemInscMunicipal = $empresaInscMunicipal->getEmpresasSemCadastroMunicipal();
$faltaCadastroInscMunicipal = count($empresasSemInscMunicipal);
$classTotalInscMunicipal = ($faltaCadastroInscMunicipal == 0) ? 'text-success' : 'text-danger';

$empresaCnae = new \App\Model\Empresa\EmpresaCnae();
$empresasSemCnae = $empresaCnae->getEmpresasSemCnae();
$faltaCadastroCnae = count($empresasSemCnae);
$classTotalCnae = ($faltaCadastroCnae == 0) ? 'text-success' : 'text-danger';

$empresaEmail = new \App\Model\Usuario\Cliente();
$empresasSemEmail = $empresaEmail->getClientesSemEmail();
$faltaCadastroEmail = count($empresasSemEmail);
$classTotalEmail = ($faltaCadastroEmail == 0) ? 'text-success' : 'text-danger';

$empresaFaturamento = new \App\Model\Empresa\Faturamento();
$empresasSemFaturamento = $empresaFaturamento->empresasSemFaturamento();
$faltaCadastroFaturamento = count($empresasSemFaturamento);
$classTotalFaturamento = ($faltaCadastroFaturamento == 0) ? 'text-success' : 'text-danger';

$empresaAcesso = new \App\Model\Empresa\Acesso();
$empresasSemAcesso = $empresaAcesso->empresasSemAcesso();
$faltaCadastroAcesso = count($empresasSemAcesso);
$classTotalAcesso = ($faltaCadastroAcesso == 0) ? 'text-success' : 'text-danger';

$dao = new GuiaDAO();
$guiasCadastradas = $dao->getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas('HONORARIOS', $dataCompetencia);
$totalGuiasPendentes = $dao->getTotalGuiasPendentes('HONORARIOS', $dataCompetencia);

$dao = new InconsistenciaDAO();
$retorno = $dao->getQuantidadeInconsistencias();
$inconsistenciasPendentes = 0;
$statusInconsistencias = 'bg-green';

if ($retorno['quantidade'] > 0) {
    $inconsistenciasPendentes = $retorno['quantidade'];
    $statusInconsistencias = 'bg-red';
}

$quantidadeTotalPendencias = $totalGuiasPendentes + $faltaCadastroPis + $faltaCadastroContaBancaria +
    $faltaCadastroInscMunicipal + $faltaCadastroAlvara + $faltaCadastroCnae + $faltaCadastroEmail +
    $faltaCadastroFaturamento + $faltaCadastroAcesso;
?>

<?= Mensagem::getMensagem($_COOKIE, 'resultado_insercao_empresa', 'mensagem_insercao'); ?>

<div class="row">
    <div class="col-md-4">
        <form class="needs-validation-loading" action="index.php" method="get" novalidate>
            <div class="social-box widget-data-div">
                <div class="widget-calendar-div">
                    <h5 class="titulo-widget-calendar"><strong>Data Competência: </strong></h5>
                        <!-- <i class="fas fa-calendar icone-widget-calendar"></i> -->
                    <h5 class="titulo-widget-calendar-rodape pt-2"><span> <?= $dataCompetenciaView ?></span></h5>
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
        <div class="card <?= ($quantidadeTotalPendencias == 0) ? 'bg-cor-accent-primaria' : 'bg-red' ?> text-light">
            <div class="card-body">
                <div class="h4 m-0"><?= $quantidadeTotalPendencias ?></div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <h6 class="text-light font-weight-bold">Pendências</h6>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body border-0 p-1 mb-0">
                    <a href="lista-guia.php?tipo=HONORARIOS" class="text-secondary font-weight-bold p-2 gif-loading">
                        Honorários <span class="badge <?= ($totalGuiasPendentes == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $totalGuiasPendentes ?></span>
                    </a>
                    <a href="pis.php" class="text-secondary font-weight-bold p-2 gif-loading">
                        PIS <span class="badge <?= ($faltaCadastroPis == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $faltaCadastroPis ?></span>
                    </a>
                    <a href="conta-bancaria.php" class="text-secondary font-weight-bold p-2 gif-loading">
                        Conta Bancária <span class="badge <?= ($faltaCadastroContaBancaria == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $faltaCadastroContaBancaria ?></span>
                    </a>
                    <a href="inscricao-municipal.php" class="text-secondary font-weight-bold p-2 gif-loading">
                        Inscrição Municipal <span class="badge <?= ($faltaCadastroInscMunicipal == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $faltaCadastroInscMunicipal ?></span>
                    </a>
                    <a href="alvara.php" class="text-secondary font-weight-bold p-2 gif-loading">
                        Alvará <span class="badge <?= ($faltaCadastroAlvara == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $faltaCadastroAlvara ?></span>
                    </a>
                    <a href="cnae.php" class="text-secondary font-weight-bold p-2 gif-loading">
                        CNAE <span class="badge <?= ($faltaCadastroCnae == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $faltaCadastroCnae ?></span>
                    </a>
                    <a href="cliente-email.php" class="text-secondary font-weight-bold p-2 gif-loading">
                        Email <span class="badge <?= ($faltaCadastroEmail == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $faltaCadastroEmail ?></span>
                    </a>
                    <a href="faturamento.php" class="text-secondary font-weight-bold p-2 gif-loading">
                        Faturamento <span class="badge <?= ($faltaCadastroFaturamento == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $faltaCadastroFaturamento ?></span>
                    </a>
                    <a href="acesso.php" class="text-secondary font-weight-bold p-2 gif-loading">
                        Acessos <span class="badge <?= ($faltaCadastroAcesso == 0) ? 'bg-cor-accent-primaria' : 'bg-danger' ?> text-white"><?= $faltaCadastroAcesso ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card <?= $statusInconsistencias ?> text-light card-button card-inconsistencia rounded" onclick="vaiParaNovaPagina('inconsistencias.php?action=all')">
            <div class="card-body">
                <div class="h4 m-0"><?= $inconsistenciasPendentes ?></div>
                <div>Inconsistências</div>
                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <small class="text-light">Aguardando solução</small>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>