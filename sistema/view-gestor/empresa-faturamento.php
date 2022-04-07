<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']);

if (!array_key_exists('viewIdEmpresa', $_SESSION)) {
    header("Location: empresa-pesquisa.php");
    die();
}

require_once('menu-left.php');
require_once('../cabecalho.php');

$empresaId = $_SESSION['viewIdEmpresa'];

$dao = new \App\DAO\FaturamentoDAO();
$faturamento = $dao->getFaturamentos($empresaId, 12);
$meses = $faturamento->getMeses();

if ($meses != null) {
    $mesesFaltantesNoMeio = $faturamento->verficaMesFaltanteNoMeio();
}
?>

<div class="alert alert-light text-center pt-4 pb-4" role="alert">
    <strong class="label-cadastro">Faturamento</strong>
</div>

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
            <a href="faturamento-pdf.php" target="_blank" class="mb-2 btn btn-padrao btn-success">Gerar Declaração</a>
        </div>
    <?php endif ?>
    
    <div class="row">
        <div class="col-12">
            <div class="card border-success">
                
                <div class="card-header bg-success rounded-0">
                    <strong class="card-title text-white">Últimos Faturamentos</strong>
                </div>
                <div class="card-body">
                    <?php if (empty($meses)) : ?>
                        <h5 class="text-center text-success">Sem Faturamentos</h5>
                    <?php else : ?>
                        <div class="table-responsive">                    
                            <table class="table">
                                <thead>
                                    <tr class='text-success'>
                                        <th scope="col">Mês</th>
                                        <th scope="col">Faturamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($meses as $mes) : ?>
                                        <tr>
                                            <td class="text-secondary font-weight-bold"><?= $mes->getMes() ?></td>
                                            <td class="text-secondary font-weight-bold">R$ <?= $mes->getFaturamento() ?></td>
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
require_once('../rodape.php');
?>