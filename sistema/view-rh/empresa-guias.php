<?php
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');

if(!array_key_exists('viewIdEmpresa', $_SESSION)) {
    header("Location: empresa-pesquisa.php");
    die();
}

$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']);
require_once('menu-left.php');
require_once('../cabecalho.php');

$dadosEmpresa = json_decode($_SESSION['infosEmpresa'], true);
?>

<div class="container-fluid">

    <div class="card">
        <div class="card-header bg-cor-accent-primaria text-center">
            <i class="fas fa-file-upload h4"></i><strong class="card-title pl-md-2 h4">Envio de Guias</strong>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12 label-cadastro text-center">
                    <h5><?=$_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']?></h5>
                </div>
            </div>

            <hr>

            <div class="row label-cadastro mt-4 mb-4">
                <div class="col-12 text-center">
                    <h5>Regime Tributário</h5>
                    <h5><?=($dadosEmpresa[0]['regime_tributario'] == 'SN')? 'Simples Nacional' : 'Presumido'?></h5>
                </div>
            </div>

            <?=Mensagem::getMensagem($_COOKIE, 'upload_guia', 'mensagem_upload_guia');?>

            <form id="form" class="needs-validation-loading" action="../controllers/empresa/insere-guia.php" enctype="multipart/form-data" method="post" autocomplete="none" novalidate>
                <input name="empresa_id" value="<?=$_SESSION['viewIdEmpresa']?>" hidden>
                <input name="usuario_id" value="<?=$_SESSION['id_usuario']?>" hidden>

                <div class="row mt-5">
                    <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="sem_guia" type="checkbox" class="custom-control-input" id="sem-guia">
                            <label class="custom-control-label" for="sem-guia">Sem Guia</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3" id="div-upload">
                    <div class="col-md-6 label-cadastro">
                        <div>
                            <label for="guia">Upload da Guia *</label>
                            <input id="input-upload" class="form-control" type="file" name="fileUpload" required>
                            <div class="invalid-feedback">
                                Escolha uma guia
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-4" id="div-guias">
                    <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="guias[INSS]" type="checkbox" class="custom-control-input" id="INSS">
                            <label class="custom-control-label" for="INSS">INSS</label>
                        </div>
                    </div>

                    <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="guias[IRRF]" type="checkbox" class="custom-control-input" id="IRRF">
                            <label class="custom-control-label" for="IRRF">IRRF</label>
                        </div>
                    </div>

                    <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="guias[FGTS]" type="checkbox" class="custom-control-input" id="FGTS">
                            <label class="custom-control-label" for="FGTS">FGTS</label>
                        </div>
                    </div>

                    <!-- <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="guias[HOLERITE]" type="checkbox" class="custom-control-input" id="HOLERITE">
                            <label class="custom-control-label" for="HOLERITE">HOLERITE</label>
                        </div>
                    </div> -->
                </div>

                <div class="row mt-3 mb-3">
                    <div id="div-vencimento" class="col-md-6 label-cadastro">
                        <label for="guia">Data de Vencimento *</label>
                        <input id="input-vencimento" placeholder="DD/MM/AAAA" class="form-control col-6" type="text" name="data_vencimento" required>
                        <div class="invalid-feedback">
                            Escolha uma data *
                        </div>
                    </div>

                    <div class="col-md-6 label-cadastro">
                        <label for="guia">Data de Competência *</label>
                        <input value="<?=$_SESSION['dataCompetenciaView']?>" readonly id="data-competencia" class="form-control col-6" type="text" name="data_competencia" required autocomplete="off">
                        <div class="invalid-feedback">
                            Escolha uma data *
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-padrao btn-success font-weight-bold">Enviar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $("#HOLERITE").click(function(){
        if ($(this).is(':checked')) {            
            $("#input-vencimento").attr("readonly", "true");
            $("#input-vencimento").val("");
        } else {
            $("#input-vencimento").removeAttr("readonly");
        }
    });
</script>

<script type="text/javascript">
    var semGuia = document.getElementById('sem-guia');
    semGuia.addEventListener('click', function(){
        if(semGuia.checked == true) {
            $("#div-upload").toggle();
            $("#input-upload").removeAttr("name");
            $("#input-upload").removeAttr("required");
            $("#div-vencimento").toggle();
            $("#input-vencimento").removeAttr("name");
            $("#input-vencimento").removeAttr("required");
        }else {
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
    $('#input-vencimento').mask('00/00/0000');
    $('#data-competencia').mask('00/0000');
</script>
