<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Consulta CPF");
require_once('menu-left.php');

require_once('../cabecalho.php');
?>

<div class="text-center mt-2 text-success">

    <div class="alert alert-success" role="alert">
        <h6 class="alert-heading">O primeiro passo para cadastrar um novo cliente, é realizar uma consulta do seu CPF, na base de dados da Receita Federal.</h6>
    </div>

    <?php if(array_key_exists('consulta_cpf', $_COOKIE) && $_COOKIE['consulta_cpf'] == "false"){ ?>
        <div class="text-center alert alert-danger alert-dismissible fade show alert-login mt-2" role="alert">
            <strong><?=$_COOKIE['resposta_cpf'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <?php if(array_key_exists('resultado_insercao', $_COOKIE) && $_COOKIE['resultado_insercao'] == "false"){ ?>
        <div class="text-center alert alert-danger alert-dismissible fade show alert-login mt-2" role="alert">
            <strong><?=$_COOKIE['resposta_insercao'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } elseif(array_key_exists('resultado_insercao', $_COOKIE) && $_COOKIE['resultado_insercao'] == "true"){ ?>
        <div class="text-center alert alert-info alert-dismissible fade show alert-login mt-2" role="alert">
            <strong><?=$_COOKIE['resposta_insercao'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <form class="form-signin needs-validation" action="verifica-cpf-bd.php" method="post" novalidate>
        <input name="cpf" type="text" id="cpf" class="form-control text-center" placeholder="CPF" required autofocus>
        <div class="invalid-feedback">
            Digite um CPF válido.
        </div>
        <button class="btn btn-entrar text-uppercase mt-2" type="submit">Continuar</button>
    </form>

</div>

<?php
require_once('rodape.php');

require_once('../rodape.php');
?>
