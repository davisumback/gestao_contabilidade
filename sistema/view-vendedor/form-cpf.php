<?php

use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Consulta CPF");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'consulta_cpf', 'resposta_cpf');?>

    <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao', 'resposta_insercao');?>

    <div class="text-center mt-2 text-success" id='conteudo'>
        <div class="alert alert-success" role="alert">
            <h6 class="alert-heading">O primeiro passo para cadastrar um novo cliente, é realizar uma consulta do seu CPF, na base de dados da Receita Federal.</h6>
        </div>

        <form id='form' class="form-signin needs-validation-loading" action="../controllers/pre-cliente/consulta-cpf.php" method="post" novalidate autocomplete="off">
            <input name="cpf" type="text" id="cpf" class="form-control text-center" placeholder="CPF" required autofocus autocomplete="off">
            <div class="invalid-feedback">
                Digite um CPF válido.
            </div>
            <button class="btn btn-entrar text-uppercase mt-2" type="submit">Continuar</button>
        </form>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $("#cpf").mask("000.000.000-00", {reverse: true});
</script>
