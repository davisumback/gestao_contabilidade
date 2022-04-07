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
?>

<?php
$dadosEmpresa = json_decode($_SESSION['infosEmpresa'], true);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 label-cadastro text-center">
            <h4> <?=$_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']?></h4>
        </div>
    </div>

    <?=Mensagem::getMensagem($_COOKIE, 'upload_guia', 'mensagem_upload_guia');?>

    <div class="row">
        <div class="col-10 mx-auto">
            <div class="linha"></div>
        </div>
    </div>

    <div class="row label-cadastro mt-4">
        <div class="col-12 text-center">
            <h6>Regime Tributário</h6>
            <h5><?=($dadosEmpresa[0]['regime_tributario'] == 'SN')? 'Simples Nacional' : 'Presumido'?></h5>
        </div>
    </div>

    <form id="form" class="needs-validation-loading" action="../controllers/empresa/a.php" enctype="multipart/form-data" method="post" autocomplete="off" novalidate >
        <input name="empresa_id" value="<?=$_SESSION['viewIdEmpresa']?>" hidden>
        <input name="usuario_id" value="<?=$_SESSION['id_usuario']?>" hidden>

        <div class="row mt-5">
            <div class="col-6 label-cadastro">
                <div class="custom-control custom-checkbox">
                    <input name="sem_guia" type="checkbox" class="custom-control-input" id="sem-guia">
                    <label class="custom-control-label" for="sem-guia">Sem Guia</label>
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-md-6 label-cadastro">
                <div id="div-upload">
                    <label for="guia">Upload da Guia *</label>
                    <input id="input-upload" class="form-control" type="file" name="fileUpload" required>
                    <div class="invalid-feedback">
                        Escolha uma guia*
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3" id="div-guias">
            <div class="col-2 label-cadastro">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="on" name="guias[HONORARIOS]" class="custom-control-input" id="HONORARIOS">
                </div>
            </div>
        </div>


        <div class="row mt-3 mb-3">
            <div id="div-vencimento" class="col-md-6 label-cadastro">
                <label for="input-vencimento">Data de Vencimento *</label>
                <input placeholder="DD/MM/AAAA" id="input-vencimento" class="form-control col-6" type="text" name="data_vencimento" required>
                <div class="invalid-feedback">
                    Escolha uma data*
                </div>
            </div>

            <div class="col-md-6 label-cadastro">
                <label for="guia">Data de Competência *</label>
                <input placeholder="MM/AAAA" id="data-competencia" class="form-control col-6" type="text" name="data_competencia" required>
                <div class="invalid-feedback">
                    Escolha uma data*
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-padrao btn-success">Enviar</button>
        </div>
    </form>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

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
