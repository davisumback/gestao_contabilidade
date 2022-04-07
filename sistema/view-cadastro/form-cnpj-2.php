<?php
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');

$menu_topo->setTituloNavegacao("");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao_empresa', 'mensagem_insercao');?>

    <div class="text-center mb-3">
        <div class="alert alert-success" role="alert">
            <h6>Cadastro de empresa com clientes já existentes!</h6>
        </div>
    </div>

    <form id='form' class="needs-validation-loading" action="../controllers/empresa/pesquisa-cnpj-2.php" method="post" autocomplete="off" novalidate>
        <input name="pasta" value="view-cadastro" hidden>

        <div class="row">
            <div class="col-3 mx-auto label-cadastro text-center">
                <label for="cnpj">CNPJ *</label>
                <input id="cnpj" class="form-control text-center" type="text" name="cnpj" required autocomplete="off">
                <div class="invalid-feedback">
                    Digite um CNPJ válido.
                </div>
            </div>
        </div>
    </form>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    var cnpj = document.getElementById("cnpj");
    cnpj.addEventListener("keyup", function() {
        if(cnpj.value.length == 18) {
            mostraGifLoading();
            $('form').submit();
        }
    });

    window.onload = function() {
        document.getElementById('cnpj').focus();
    };

    $("#cnpj").mask("00.000.000/0000-00", {reverse: true});
</script>
