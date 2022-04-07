<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Emissão de NFSe =)');
require_once('menu-left.php');
require_once('../cabecalho.php');

$mensagem = null;
$empresaResult = null;

if (array_key_exists('empresasId', $_GET)) {
    try {
        $empresa = new App\Model\Empresa\Empresa();
        $empresaResult = $empresa->isEmpresa($_GET['empresasId']);
        $dataPesquisa = $_SESSION['dataCompetencia']; // VERIFICAR ISSO AQUI;

        $data = Helpers::modificaDataPeriodo($dataPesquisa, '+1 month', 'Y-m-d');

        if (array_key_exists('data', $_GET) && $_GET['data'] != '') {
            $dataPesquisa = '01/' . $_GET['data'];
            $data = Helpers::formataDataBd($dataPesquisa);
        }

        $dataPesquisaView = Helpers::formataDataCompetenciaView($data);

        $data = explode('-', $data);

        $dao = new \App\DAO\EmpresaNfseDAO();
        $notasFiscais = $dao->getAllMes($_GET['empresasId'], $data[1], $data[0]);

        $consulta = new \App\Model\Empresa\ConsultaContaBancaria();
        $conta = $consulta->getContaBancariaPadrao($_GET['empresasId']);
    } catch (\Throwable $th) {
        $mensagem = $th->getMessage();
    }
}
?>

<div class="container-fluid">
    <?php if ($mensagem != null) : ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong><?=$mensagem?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <?php if (! empty($empresaResult)) : ?>
        <?php if (! empty($conta)) : ?>
            <div class="text-center mb-3">
                <button class="btn btn-padrao btn-success font-weight-bold" data-toggle="modal" data-target="#emite">Emitir nota fiscal</button>
            </div>
        <?php else : ?>
            <div class="alert alert-danger alert-dismissible fade show text-center">
                <strong>Empresa sem Conta Bancária padrão cadastrada.</strong>
            </div>
        <?php endif ?>

        <div class="row justify-content-end">
            <div class="col-md-3">
                <div class="card bg-light mb-3 text-center rounded borda-cor-primaria">
                    <div class="card-header bg-cor-primaria p-2"><strong>Pesquisar NFSe</strong></div>
                        <div class="card-body texto-padrao p-2">
                            <form class="needs-validation-loading" action="nota-fiscal.php" method="get" novalidate autocomplete="none">
                                <input name="empresasId" value="<?=$_GET['empresasId']?>" hidden>
                                <div class="row justify-content-center">
                                    <div class="col-md-11">
                                        <input name="data" type="text" class="form-control text-center data" placeholder="MM/AAAA" autocomplete="off" required>
                                        <div class="invalid-feedback">Obrigatório*</div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <div class="col-md-5">
                                        <button class="btn btn-padrao btn-sm btn-success font-weight-bold" type="submit">
                                            Buscar
                                        </button>
                                    </div>
                                </div>                        
                            </form>
                        </div>             
                    </div>              
                </div>
            </div>
        </div>

        <?php Mensagem::getMensagem($_COOKIE, 'emissaoNotaFiscal', 'mensagemNotaFiscal'); ?>

        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center bg-cor-primaria rounded-0">
                    <strong class="card-title  text-white">Notas Fiscais de <?=$dataPesquisaView?></strong>
                </div>                
                <div class="card-body">
                    <?php if (empty($notasFiscais)) : ?>
                        <div class="alert alert-secondary text-center mt-5 mb-5" role="alert">
                            <strong>Nenhuma emissão de encontrada.</strong> 
                        </div>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="label-cadastro">
                                        <th scope="col">Nº</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Data</th>
                                        <th scope="col">Status</th>
                                        <th class='text-center' scope="col">Nota</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notasFiscais as $nota) : ?>
                                        <tr class="vertical-align-middle">
                                            <td class="text-secondary font-weight-bold"><?=$nota->getId()?></td>
                                            <td class="text-secondary font-weight-bold">R$ <?=Helpers::formataMoedaView($nota->getValor())?></td>
                                            <td class="text-secondary font-weight-bold"><?=Helpers::formataDataView($nota->getEmissao())?></td>
                                            <td class="text-<?=$nota->getCorStatus()?> font-weight-bold"><?=$nota->getSituacaoConvertida()?></td>
                                            <td class="text-center"><?=$nota->getPdf()?></td>
                                            <td class="text-center"><?=$nota->getCancelar()?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif ?>                    
                </div>
            </div>
        </div>

    <?php else : ?>
        <div class="row">
            <div class="mx-auto col-md-4">
                <div class="card rounded">
                    <div class="card-header bg-success text-white text-center font-weight-bold">
                        Escolha a empresa para emitir a Nota Fiscal
                    </div>
                    <div class="card-body">
                        <form action="nota-fiscal.php" class="needs-validation-loading" novalidate>
                            <div class="form-group text-center">
                                <label class="label-cadastro">Empresa</label>
                                <input name="empresasId" type="text" class="text-center mx-auto form-control col-6" maxlength="4" required autocomplete="off">
                                <div class="invalid-feedback">Obrigatório *</div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-padrao btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>

<?php include __DIR__ . '/../modal/nfse/empresa.php'; ?>

<?php
if (array_key_exists('empresasId', $_GET) && (! empty($empresaResult)) && (! empty($conta)) ) {
    $empresasId = $_GET['empresasId'];

    if ($empresaResult[0]['regime_tributario'] == 'Presumido') {
        include __DIR__ . '/../modal/nfse/emite-presumido.php';
    } else {
        $dao = new \App\DAO\EmpresaDAO();
        $retorno = $dao->getEmpresaAliquota($empresasId, $_SESSION['dataCompetencia']);
        $aliquotaIssSimplesNacional = $retorno['aliquota'];
        include __DIR__ . '/../modal/nfse/emite-sn.php';
    }
    include __DIR__ . '/../modal/nfse/cancela.php';
}
?>

<?php 
require_once('rodape.php');
require_once('../rodape.php');
?>

<?php if (array_key_exists('empresasId', $_COOKIE)) : ?>
    <?php $empresasId = $_COOKIE['empresasId']; ?>
    <script>
        $(document).ready(function(){
            $('#emite').modal('show');
        });
    </script>
<?php endif ?>

<script>
    $('.real').mask('000.000,00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.aliquota').mask('0.00');
    $('.data').mask('00/0000');
</script>

<script>
    $('#cancelaNota').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('nota-fiscal-id');
        
        var modal = $(this)
        modal.find('#notaFiscalId').val(id)
    })
</script>