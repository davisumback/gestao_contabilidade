<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao($_GET['domestica_id'] . ' - ' . $_GET['domestica_nome'] . ' - '. $_GET['domestica_cpf']);
require_once('menu-left.php');
require_once('../cabecalho.php');

?>

<div class="container-fluid">

    <div class="card">
        <div class="card-header bg-cor-accent-primaria text-center">
            <i class="fas fa-file-upload h4"></i><strong class="card-title pl-md-2 h4">Envio de Guias</strong>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12 label-cadastro text-center">
                    <h3><span><?=$_GET['domestica_id']?></span> - <?=$_GET['domestica_nome']?> - <span class="cpf"><?=$_GET['domestica_cpf']?></span></h3>
                </div>
            </div>

            <?=Mensagem::getMensagem($_COOKIE, 'upload_guia', 'mensagem_upload_guia');?>

            <form id="form" class="needs-validation-loading" action="../controllers/domestica/insere-guia-domestica.php" enctype="multipart/form-data" method="post" autocomplete="none" novalidate>
                <input name="usuario_id" value="<?=$_SESSION['id_usuario']?>" hidden>
                <input name="domestica_nome" value="<?=$_GET['domestica_nome']?>" hidden>
                <input name="domestica_cpf" value="<?=$_GET['domestica_cpf']?>" hidden>
                <input name="domestica_id" value="<?=$_GET['domestica_id']?>" hidden>

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
                            <input id="input-upload" class="form-control" type="file" name="fileUpload" multiple required>
                            <div class="invalid-feedback">
                                Escolha uma guia
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-4" id="div-guias">
                    <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="guias[HONORARIO]" type="checkbox" class="custom-control-input" id="HONORARIO">
                            <label class="custom-control-label" for="HONORARIO">HONORARIO</label>
                        </div>
                    </div>

                    <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="guias[RECIBO]" type="checkbox" class="custom-control-input" id="RECIBO">
                            <label class="custom-control-label" for="RECIBO">RECIBO</label>
                        </div>
                    </div>

                    <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="guias[RELATORIO]" type="checkbox" class="custom-control-input" id="RELATORIO">
                            <label class="custom-control-label" for="RELATORIO">RELATÓRIO</label>
                        </div>
                    </div>

                    <div class="col-2 label-cadastro">
                        <div class="custom-control custom-checkbox">
                            <input name="guias[PAGAMENTO]" type="checkbox" class="custom-control-input" id="PAGAMENTO">
                            <label class="custom-control-label" for="PAGAMENTO">PAGAMENTO</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div id="div-vencimento" class="col-md-6 label-cadastro">
                        <label for="guia">Data de Vencimento *</label>
                        <input id="input-vencimento" placeholder="DD/MM/AAAA" class="form-control col-6" type="text" name="data_vencimento" required>
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
    $('.cpf').mask('000.000.000-00');
</script>
