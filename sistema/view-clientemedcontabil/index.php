<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

$empresasId = $_SESSION['empresasId'];

$os = new \App\Model\Os\OrdemDeServico;
$quantidadeOsPendentes = $os->getOsPorStatus($_SESSION['id_usuario'], 'PENDENTE');
$pendenciasCredenciamento = $os->getOsPorTipo($_SESSION['id_usuario'], 1, 'PENDENTE');
// $pendenciasFaturamento = $os->getOsPendentesPorTipo($_SESSION['id_usuario'], 2);
$pendenciasCertidao = $os->getOsPorTipo($_SESSION['id_usuario'], 3, 'PENDENTE');
$pendenciasRecalculoGuia = $os->getOsPorTipo($_SESSION['id_usuario'], 4, 'PENDENTE');
$pendenciasDeclaracaoRendimento = $os->getOsPorTipo($_SESSION['id_usuario'], 7, 'PENDENTE');

$dao = new \App\DAO\EmpresaNfseDAO();
$notasFiscais = $dao->getUltimasNotas($empresasId, 5);

$faturamentoDao = new \App\DAO\FaturamentoDAO();
$faturamento = $faturamentoDao->getFaturamentos($empresasId, 5);
$meses = $faturamento->getMeses();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card border-info">
                <div class="card-header bg-info rounded-0">
                    <strong class="card-title text-white">Últimas Notas Fiscais</strong>
                </div>
                <div class="card-body">
                    <?php if (empty($notasFiscais)) :?>
                        <h5 class="text-center text-info">Sem Notas Fiscais</h5>
                    <?php else : ?>
                        <table class="table">
                            <thead>
                                <tr class="text-info">
                                    <th scope="col">Nº</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notasFiscais as $nota) : ?>
                                    <tr>
                                        <td class="text-secondary font-weight-bold"><?=$nota->getId()?></td>
                                        <td class="text-secondary font-weight-bold">R$ <?=Helpers::formataMoedaView($nota->getValor())?></td>
                                        <td class="text-secondary font-weight-bold"><?=Helpers::formataDataView($nota->getEmissao())?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col text-center">
                                <a class="btn btn-padrao btn-info btn-sm font-weight-bold text-white" href="nota-fiscal.php">Ver Mais</a>
                            </div>
                        </div>
                    <?php endif ?>                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-info">
                <div class="card-header bg-info rounded-0">
                    <strong class="card-title text-white">Últimos Faturamentos</strong>
                </div>
                <div class="card-body">
                    <?php if (empty($meses)) :?>
                        <h5 class="text-center text-info">Sem Faturamentos</h5>
                    <?php else : ?>
                        <table class="table">
                            <thead>
                                <tr class="text-info">
                                    <th scope="col">Mês</th>
                                    <th scope="col">Faturamento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($meses as $mes) : ?>
                                    <tr>
                                        <td class="text-secondary font-weight-bold"><?=$mes->getMes()?></td>
                                        <td class="text-secondary font-weight-bold">R$ <?=$mes->getFaturamento()?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col text-center">
                                <a class="btn btn-padrao btn-info btn-sm font-weight-bold text-white" href="faturamento.php">Ver Mais</a>
                            </div>
                        </div>
                    <?php endif ?>                   
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="row">
                <div class="col-12">
                    <div class="card <?=($quantidadeOsPendentes == 0) ? 'bg-info' : 'bg-danger'?> text-light">
                        <div class="card-body">
                            <div class="h4 m-0"><?=$quantidadeOsPendentes?></div>
                            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;"
                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <h6 class="text-light font-weight-bold">Ordem de Serviços Pendentes</h6>
                        </div>
                        <div class="collapse show px-0" id="collapseExample">
                            <div class="card card-body border-0 p-1 mb-0">
                                <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=1" class="text-secondary font-weight-bold p-2 gif-loading">
                                    Credenciamento <span class="badge <?=($pendenciasCredenciamento == 0) ? 'bg-info' : 'bg-danger'?> text-white"><?=$pendenciasCredenciamento?></span>
                                </a>
                                <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=3" class="text-secondary font-weight-bold p-2 gif-loading">
                                    Emissão de Certidão <span class="badge <?=($pendenciasCertidao == 0) ? 'bg-info' : 'bg-danger'?> text-white"><?=$pendenciasCertidao?></span>
                                </a>
                                <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=4" class="text-secondary font-weight-bold p-2 gif-loading">
                                    Recálculo de Guias <span class="badge <?=($pendenciasRecalculoGuia == 0) ? 'bg-info' : 'bg-danger'?> text-white"><?=$pendenciasRecalculoGuia?></span>
                                </a>
                                <a href="ordem-servico-lista.php?method=getAllRecebidas&tipoOs=7" class="text-secondary font-weight-bold p-2 gif-loading">
                                    Declaração de Rendimento <span class="badge <?=($pendenciasDeclaracaoRendimento == 0) ? 'bg-info' : 'bg-danger'?> text-white"><?=$pendenciasDeclaracaoRendimento?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border-info" onclick="vaiParaNovaPagina('empresa-arquivos.php')" style="cursor: pointer;">
                        <div class="card-body p-0 clearfix">
                            <i class="far fa-file-alt bg-info p-4 h3 mb-0 mr-3 float-left text-light"></i>
                            <div class="h5 text-info mt-2 mb-0 pt-2 pt-md-2">
                                Documentos Disponíveis
                            </div>
                            <div class="text-muted font-xs small">Clique para visualizar</div>
                        </div>
                    </div>
                </div>            
            </div>        
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
?>