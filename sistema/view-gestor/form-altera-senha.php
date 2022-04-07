<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Alterar Senha");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<div class="text-center mt-2 text-success" id="conteudo">
    <div class="text-center alert alert-danger alert-dismissible fade show alert-login mt-2" role="alert" hidden id="resposta-senhas">
        <strong id="mensagem-senhas"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php if (array_key_exists('altera_senha', $_COOKIE) && $_COOKIE['altera_senha'] == "false") { ?>
        <div class="text-center alert alert-danger alert-dismissible fade show alert-login mt-2" role="alert">
            <strong><?= $_COOKIE['resposta_altera_senha']; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php 
} ?>

    <?php if (array_key_exists('altera_senha', $_COOKIE) && $_COOKIE['altera_senha'] == "true") { ?>
        <div class="text-center alert alert-info alert-dismissible fade show alert-login mt-2" role="alert">
            <strong><?= $_COOKIE['resposta_altera_senha']; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php 
} ?>

    <form class="form-signin needs-validation" action="../controllers/senha/altera-senha.php" method="post" novalidate id="form">
        <input name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>" hidden>
        <input name="pasta" value="<?= $_SESSION['pasta'] ?>" hidden>
        <input name="senha" type="password" id="senha" class="form-control text-center" placeholder="Nova senha" required autofocus maxlength="30">

        <input style="margin-top:15px;margin-bottom:10px;" name="confirma_senha" type="password" id="confirma_senha" class="form-control text-center" placeholder="Confirmação de nova senha" required autofocus maxlength="30">

        <button class="btn btn-entrar text-uppercase mt-2" type="button" onclick="enviaFormulario()">Confirmar</button>
    </form>
</div>

<script src="../assets/custom-js/loading-automatico.js" charset="utf-8"></script>

<script type="text/javascript">
    var senha = document.getElementById("senha");
    var confirmaSenha = document.getElementById("confirma_senha");
    var form = document.getElementById("form");
    var divSenhas = document.getElementById("resposta-senhas");
    var mensagemSenhas = document.getElementById("mensagem-senhas");

    function enviaFormulario(){
        divSenhas.setAttribute("hidden","true");
        if(senha.value != confirmaSenha.value) {
            divSenhas.removeAttribute("hidden");
            mensagemSenhas.innerHTML = "As senhas são diferentes.";
            return;
        }else if(senha.value == "" || confirmaSenha.value == "") {
            divSenhas.removeAttribute("hidden");
            mensagemSenhas.innerHTML = "As senhas não podem ser em branco.";
            return;
        }else {
            mostraGifLoading();
            form.submit();
        }
    }

</script>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script src="../assets/custom-js/loading-automatico.js" charset="utf-8"></script>
