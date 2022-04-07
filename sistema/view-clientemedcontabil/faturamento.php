<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

$empresasId = $_SESSION['empresasId'];
$faturamentoDao = new \App\DAO\FaturamentoDAO();
$faturamento = $faturamentoDao->getFaturamentos($empresasId, 12);
$meses = $faturamento->getMeses();

if ($meses != null) {
    $mesesFaltantesNoMeio = $faturamento->verficaMesFaltanteNoMeio();
}
?>

<div class="container-fluid">
    <?php if ($mesesFaltantesNoMeio) : ?>
        <div class="alert alert-danger">
            Meses pendentes de valor do faturamento
            <ul class="ml-5">
                <?php foreach ($mesesFaltantesNoMeio as $mes) : ?>
                    <li><strong><?= Helpers::formataDataCompetenciaView($mes) ?></strong></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <?php if (empty($mesesFaltantesNoMeio) && $meses != null) : ?>
        <div class="text-right">
            <a href="faturamento-pdf.php" target="_blank" class="mb-2 btn btn-padrao btn-info">Gerar Declaração</a>
        </div>
    <?php endif ?>
    
    <div class="row">
        <div class="col-12">
            <div class="card border-info">
                <div class="card-header bg-info rounded-0">
                    <strong class="card-title text-white">Últimos Faturamentos</strong>
                </div>
                <div class="card-body">
                    <?php if (empty($meses)) : ?>
                        <h5 class="text-center text-info">Sem Faturamentos</h5>
                    <?php else : ?>
                        <div class="table-responsive">                    
                            <table class="table">
                                <thead>
                                    <tr class='text-info'>
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
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
?>