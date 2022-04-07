<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;
use App\DAO\GuiaDataPadraoDAO;
use App\DAO\EmpresaFaturamentoDAO;

require_once('header.php');
require_once('menu-topo.php');

if (!array_key_exists('viewIdEmpresa', $_SESSION)) {
    header("Location: empresa-pesquisa.php");
    die();
}

$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']);
require_once('menu-left.php');
require_once('../cabecalho.php');

$dataCompetenciaCompleta = '01/' . $_SESSION['dataCompetenciaView'];

$dao = new GuiaDataPadraoDAO();

$datasPadraoDas = $dao->getDataPadraoGuia('DAS');
$vencimentoDas = Helpers::formataDataVencimentoView($datasPadraoDas['dia_vencimento'], $_SESSION['dataCompetenciaView']);

$datasPadraoPis = $dao->getDataPadraoGuia('PIS');
$vencimentoPis = Helpers::formataDataVencimentoView($datasPadraoPis['dia_vencimento'], $_SESSION['dataCompetenciaView']);

$datasPadraoIrpj = $dao->getDataPadraoGuia('IRPJ');
$vencimentoIrpj = Helpers::formataDataVencimentoView($datasPadraoIrpj['dia_vencimento'], $_SESSION['dataCompetenciaView']);

$faturamentoDAO = new EmpresaFaturamentoDAO();
$faturamentoDataCompetencia = $faturamentoDAO->getFaturamentoEnvioGuia($_SESSION['viewIdEmpresa'], Helpers::formataDataBD($dataCompetenciaCompleta));

$dadosEmpresa = json_decode($_SESSION['infosEmpresa'], true);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-cor-accent-primaria">
            <i class="fas fa-file-upload h4"></i><strong class="card-title pl-md-2 h4">Envio de Guia</strong>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12 label-cadastro text-center">
                    <h3><?=$_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']?></h3>
                </div>
            </div>

            <?=Mensagem::getMensagem($_COOKIE, 'upload_guia', 'mensagem_upload_guia');?>

            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="linha"></div>
                </div>
            </div>

            <?php if ($dadosEmpresa[0]['regime_tributario'] == 'SN') : ?>
                <?php
                    $dao = new \App\DAO\EmpresaDAO();
                    
                    $dataBd = Helpers::formataDataPeriod('sub', $dataCompetenciaCompleta, 'P1M', 'Y-m-d');
                    $empresaAliquota = $dao->getEmpresaAliquota($_SESSION['viewIdEmpresa'], $dataBd);
                ?>
                <div class="row label-cadastro mt-4">
                    <div class="col-12 text-center">
                        <h6>Regime Tributário</h6>
                        <h5>Simples Nacional</h5>
                    </div>
                </div>

                <div class="row label-cadastro mt-4">
                    <div class="col-6">
                        <h5>Alíquota <?=$dataBd = Helpers::formataDataPeriod('sub', $dataCompetenciaCompleta, 'P1M', 'm/Y')?>: <strong><?=($empresaAliquota == null) ? 0 : $empresaAliquota['aliquota']?></strong></h5>
                    </div>

                    <div class="col-6">
                        <h5>Fator R <?=$dataBd = Helpers::formataDataPeriod('sub', $dataCompetenciaCompleta, 'P1M', 'm/Y')?>: <strong><?=($empresaAliquota == null) ? 0 : $empresaAliquota['fator_r']?></strong></h5>
                    </div>
                </div>

                <form id="form" class="needs-validation-loading" action="../controllers/empresa/insere-guia.php" enctype="multipart/form-data" method="post" autocomplete="off" novalidate>
                    <input name="empresa_id" value="<?=$_SESSION['viewIdEmpresa']?>" hidden>
                    <input name="usuario_id" value="<?=$_SESSION['id_usuario']?>" hidden>

                    <div class="row mt-3 mb-3">
                        <div class="col-md-6 label-cadastro">
                            <label>Alíquota *</label>
                            <input class="form-control col-6 aliquota" type="text" name="aliquota" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>

                        <div class="col-md-6 label-cadastro">
                            <label>Fator R *</label>
                            <input class="form-control col-6 fatorR" type="text" name="fatorR" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-6 label-cadastro">
                            <div class="custom-control custom-checkbox">
                                <input name="sem_guia" type="checkbox" class="custom-control-input" id="sem-guia">
                                <label class="custom-control-label" for="sem-guia">Sem Guia DAS</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3" id="div-upload">
                        <div class="col-md-6 label-cadastro">
                            <div>
                                <label for="guia">Upload da Guia DAS*</label>
                                <input id="input-upload" class="form-control" type="file" name="fileUpload" required>
                                <div class="invalid-feedback">
                                    Escolha uma guia
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 label-cadastro">
                            <label>Faturamento</label>

                            <?php if ($faturamentoDataCompetencia != false) : ?>
                                <h4>R$ <?=Helpers::formataMoedaView($faturamentoDataCompetencia['faturamento'])?></h4>
                            <?php else : ?>
                                <input class="form-control col-6 faturamento" type="text" name="faturamento" required>
                                <div class="invalid-feedback">
                                    Obrigatório *
                                </div>                                
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="row mt-3" id="div-guias">
                        <div class="col-2 label-cadastro">
                            <div class="custom-control custom-checkbox" hidden>
                                <input value="on" name="guias[DAS]" class="custom-control-input" id="DAS">
                                <label class="custom-control-label" for="DAS">DAS</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3">
                        <div id="div-vencimento" class="col-md-6 label-cadastro">
                            <label>Data de Vencimento *</label>
                            <input value="<?=$vencimentoDas?>" placeholder="DD/MM/AAAA" id="input-vencimento" class="form-control col-6" type="text" name="data_vencimento" required>
                            <div class="invalid-feedback">
                                Escolha uma data *
                            </div>
                        </div>

                        <div class="col-md-6 label-cadastro">
                            <label>Data de Competência *</label>
                            <input readonly value="<?=$_SESSION['dataCompetenciaView']?>" placeholder="MM/AAAA" id="data-competencia" class="form-control col-6" type="text" name="data_competencia" required>
                            <div class="invalid-feedback">
                                Escolha uma data *
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-padrao btn-success font-weight-bold">Enviar</button>
                    </div>
                </form>

            <?php else : ?>
                <div class="row label-cadastro mt-4">
                    <div class="col-12 text-center">
                        <h6>Regime Tributário</h6>
                        <h5>Presumido</h5>
                    </div>
                </div>

                <form id="form" class="needs-validation-loading" action="../controllers/empresa/insere-guia.php" enctype="multipart/form-data" method="post" autocomplete="off" novalidate >
                    <input name="empresa_id" value="<?=$_SESSION['viewIdEmpresa']?>" hidden>
                    <input name="usuario_id" value="<?=$_SESSION['id_usuario']?>" hidden>
                    <input name="regime_tributario" value="Presumido" hidden>

                    <div class="row mt-5">
                        <div class="col-6 label-cadastro">
                            <div class="custom-control custom-checkbox">
                                <input name="sem_guia" type="checkbox" class="custom-control-input" id="sem-guia">
                                <label class="custom-control-label" for="sem-guia">Sem Guia</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3" id="div-upload">
                        <div class="col-md-6 label-cadastro">
                            <div>
                                <label for="guia">Upload da Guia*</label>
                                <input id="input-upload" class="form-control" type="file" name="fileUpload" required>
                                <div class="invalid-feedback">
                                    Escolha uma guia
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3" id="div-guias">
                        <div class="col-2 label-cadastro">
                            <div class="custom-control custom-checkbox">
                                <input name="guias[PIS]" type="checkbox" class="custom-control-input" id="PIS">
                                <label class="custom-control-label" for="PIS">PIS</label>
                            </div>
                        </div>

                        <div class="col-2 label-cadastro">
                            <div class="custom-control custom-checkbox">
                                <input name="guias[COFINS]" type="checkbox" class="custom-control-input" id="COFINS">
                                <label class="custom-control-label" for="COFINS">COFINS</label>
                            </div>
                        </div>

                        <div class="col-2 label-cadastro">
                            <div class="custom-control custom-checkbox">
                                <input name="guias[IRPJ]" type="checkbox" class="custom-control-input" id="IRPJ">
                                <label class="custom-control-label" for="IRPJ">IRPJ</label>
                            </div>
                        </div>

                        <div class="col-2 label-cadastro">
                            <div class="custom-control custom-checkbox">
                                <input name="guias[CSLL]" type="checkbox" class="custom-control-input" id="CSLL">
                                <label class="custom-control-label" for="CSLL">CSLL</label>
                            </div>
                        </div>

                        <div class="col-2 label-cadastro">
                            <div class="custom-control custom-checkbox">
                                <input name="guias[ISS]" type="checkbox" class="custom-control-input" id="ISS">
                                <label class="custom-control-label" for="ISS">ISS</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3">
                        <div class="col-md-6 label-cadastro">
                            <label>Faturamento </label>
                            <?php if ($faturamentoDataCompetencia != false) : ?>
                                <h4>R$ <?=Helpers::formataMoedaView($faturamentoDataCompetencia['faturamento'])?></h4>
                            <?php else : ?>
                                <input class="form-control col-6 faturamento" type="text" name="faturamento" required>
                                <div class="invalid-feedback">
                                    Obrigatório *
                                </div>                                
                            <?php endif ?>
                        </div>                        
                    </div>

                    <div class="row mt-3 mb-3">
                        <div id="div-vencimento" class="col-md-6 label-cadastro">
                            <label for="guia">Data de Vencimento *</label>
                            <input placeholder="DD/MM/AAAA" id="input-vencimento" class="form-control col-6" type="text" name="data_vencimento" required>
                            <div class="invalid-feedback">
                                Escolha uma data *
                            </div>
                        </div>

                        <div class="col-md-6 label-cadastro">
                            <label for="guia">Data de Competência *</label>
                            <input readonly value="<?=$_SESSION['dataCompetenciaView']?>" id="data-competencia" class="form-control col-6" type="text" name="data_competencia" required>
                            <div class="invalid-feedback">
                                Escolha uma data *
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-padrao btn-success font-weight-bold">Enviar</button>
                    </div>
                </form>
            <?php endif ?>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    var semGuia = document.getElementById('sem-guia');
    var form = document.getElementById('form');
    var inputSemGuia = document.createElement("INPUT");
    semGuia.addEventListener('click', function(){
        if (semGuia.checked == true) {
            inputSemGuia.setAttribute("name", "sem_guia");
            inputSemGuia.setAttribute("value", 1);
            inputSemGuia.setAttribute("hidden", "true");
            form.appendChild(inputSemGuia);
            $("#div-upload").toggle();
            $("#input-upload").removeAttr("name");
            $("#input-upload").removeAttr("required");
            $("#div-vencimento").toggle();
            $("#input-vencimento").removeAttr("name");
            $("#input-vencimento").removeAttr("required");
        } else {
            inputSemGuia.removeAttribute("name");
            inputSemGuia.removeAttribute("value");
            $("#div-upload").toggle();
            $("#input-upload").attr("name","fileUpload");
            $("#input-upload").attr("required", "true");
            $("#div-vencimento").toggle();
            $("#input-vencimento").attr("name", "data_vencimento");
            $("#input-vencimento").attr("required", "true");
        }
    });
</script>

<script type="text/javascript">
    $('#PIS').change( function() {
        if ($(this).is(':checked')) {

            $('#input-vencimento').val('<?=$vencimentoPis?>');
        } else {
            $('#input-vencimento').val('');
        }
    });

    $('#IRPJ').change( function() {
        if ($(this).is(':checked')) {
            $('#input-vencimento').val('<?=$vencimentoIrpj?>');
        } else {
            $('#input-vencimento').val('');
        }
    });

    $('#sem-guia').change( function() {
        if ($(this).is(':checked')) {
            $('.faturamento').removeAttr('required');
        } else {
            $('.faturamento').attr('required', 'true');
        }
    });
</script>

<script type="text/javascript">
    $('#input-vencimento').mask('00/00/0000');
    $('#data-competencia').mask('00/0000');
    $('.aliquota').mask('00.00');
    $('.fatorR').mask('000');
    $('.faturamento').mask('000.000.000.000.000,00', {reverse: true});
</script>
