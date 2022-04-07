<?php
use App\Model\Os\OrdemDeServico;
use App\Model\Os\TipoCertidao;
use App\Model\Os\TipoOrdemDeServico;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Ordem de Serviço");
require_once('menu-left.php');
require_once('../cabecalho.php');

$metodo = $_GET['method'];

$ordemDeServico = new OrdemDeServico();
$os = $ordemDeServico->$metodo($_REQUEST['os']);
$tipoOs = new TipoOrdemDeServico();
$tiposOs = $tipoOs->getAll();

$cor = $ordemDeServico->decideCor($os[0]['status']);
?>

<div class="container-fluid">
    <div class="alert alert-light text-center label-cadastro" role="alert">
        <h6>Ordem de Serviço do tipo <strong><?=$os[0]['titulo']?></strong></h6>
        <?php if ($_GET['method'] != 'getOsOutros') : ?>
            <h6 class="mt-1"><?=$os[0]['empresas_id']?> | <?=$os[0]['nome_empresa']?></h6>
        <?php endif ?>
    </div>

    <?=\App\Helper\Mensagem::getMensagem($_COOKIE, 'insercaoOs', 'mensagemInsercaoOs')?>

    <div class="row justify-content-center">
        <div class="col-md-7 col-sm-12">
            <div class="card text-center border-<?=$cor?> rounded">
                <div class="card-header bg-<?=$cor?>">
                    <strong class="text-dark">O.S nº <?=$_GET['os']?> - <?=$os[0]['status']?></strong>
                </div>

                <div class="card-body">
                    <h5 class="card-title text-right">
                        <span class="badge badge-secondary">
                            <?php
                                $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
                                $now = $date->format('Y-m-d');
                                $dias = Helpers::calculaDiferencaDatas($now, $os[0]['created_at'], 'days');

                                $saida = 'Criada há ' . $dias . ' dias';

                                if ($dias == 0) {
                                    $saida ='Criada hoje';
                                } else if ($dias == 1) {
                                    $saida = 'Criada há ' . $dias . ' dia';
                                }

                                echo $saida;
                            ?>
                        </span>
                    </h5>

                    <?php if ($_GET['method'] != 'getOsOutros') : ?>
                        <h5 class="card-title">Itens dessa Ordem de Serviço:</h5>
                        <?php foreach ($os as $valor) : ?>
                            <p class="card-text"><strong><?=$valor['descricao_emissao'] . ' ' . $valor['nomeItemOs']?></strong></p>
                        <?php endforeach ?>
                    <?php endif ?>

                    <?php if ($os[0]['tipoOs'] == 6) : ?>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-dark"><strong>Setor <?=$os[0]['setorNome']?></strong></h5>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-10 mx-auto text-left">
                                <p style="text-indent:20px;text-align:justify;" class="text-secondary">Setor <?=$os[0]['descricao']?></h5>
                            </div>
                        </div>
                    <?php endif?>

                    <?php if ($os[0]['tipoOs'] == 1) : ?>
                        <?php $credenciamento = new App\Model\Os\Credenciamento(); ?>
                        <?php $credenciamento = $credenciamento->getDadosCredenciamento($_GET['os']); ?>

                        <div class="row">
                            <div class="col-12">
                                <h6 class="label-cadastro">Edital</h6>
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-12">
                                <a 
                                    class="text-secondary" 
                                    href="../../grupobfiles/empresas/<?=$credenciamento[0]['empresas_id']?>/credenciamento/<?=$credenciamento[0]['pasta'].'/'.$credenciamento[0]['edital']?>" 
                                    target="_blank"
                                >
                                    <strong><?=$credenciamento[0]['edital']?></strong>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <?php foreach ($credenciamento as $valor) : ?>
                                <div class="col-6 mt-3 mb-1">
                                    <h6 class="label-cadastro">Valor da Proposta</h6>
                                    <h6 class="font-weight-bold text-secondary">R$ <?=\App\Helper\Helpers::formataMoedaView($valor['valor'])?></h6>
                                </div>
                                <div class="col-6 mt-3 mb-1">
                                    <h6 class="label-cadastro">Descrição da Proposta</h6>
                                    <h6 class="font-weight-bold text-secondary"><?=$valor['descricao']?></h6>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                    <div class="row mt-3">
                        <div class="col">
                            <?php if ($_GET['situation'] == 'getAllRecebidas' && $os[0]['status'] == 'PENDENTE') : ?>
                                <button type="button" data-toggle="modal" data-target="#atender-<?=strtolower($os[0]['nomeArquivo'])?>" class="btn btn-padrao btn-success btn-primary">Atender</button>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ((! empty($os)) && ($_GET['situation'] == 'getAllRecebidas')) {
    foreach ($tiposOs as $tipo) {
        if ($tipo['id'] == $os[0]['tipoOs']) {
            include __DIR__ . '/../modal/os/'.strtolower($tipo['tipo']).'/atender-' . strtolower($os[0]['nomeArquivo']) . '.php';
        }
    }
}
?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script>
     $('.certidao-data-validade').mask('00/00/0000');
</script>