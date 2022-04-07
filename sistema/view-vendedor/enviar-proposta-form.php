<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Enviar proposta");
require_once('menu-left.php');

require_once('../cabecalho.php');
?>

<div class="text-center mt-2 text-success">

    <div class="alert alert-success mb-2" role="alert">
        <h6 class="alert-heading">Antes de reenviar a proposta.</h6>
        <h6 class="alert-heading"> É de suma importância você confirmar com o cliente se ele já não recebeu o nosso e-mail.</h6>
    </div>

    <?php if(array_key_exists('consulta_cpf', $_COOKIE) && $_COOKIE['consulta_cpf'] == "false"){ ?>
        <div class="text-center alert alert-danger alert-dismissible fade show alert-login" role="alert">
            <strong><?=$_COOKIE['resposta_cpf'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <?php if(array_key_exists('resultado_envio_proposta', $_COOKIE) && $_COOKIE['resultado_envio_proposta'] == "false"){ ?>
        <div class="text-center alert alert-danger alert-dismissible fade show alert-login" role="alert">
            <strong><?=$_COOKIE['resposta_envio_proposta'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } elseif(array_key_exists('resultado_envio_proposta', $_COOKIE) && $_COOKIE['resultado_envio_proposta'] == "true"){ ?>
        <div class="text-center alert alert-info alert-dismissible fade show alert-login" role="alert">
            <strong><?=$_COOKIE['resposta_envio_proposta'];?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>


    <form class="form-signin mt-2 needs-validation" action="envia-proposta.php" method="post" novalidate>
        <input name="cpf" type="text" id="cpf" class="form-control text-center mt-3" placeholder="CPF cliente" required autofocus>
        <div class="invalid-feedback">
            Digite um CPF válido.
        </div>
        <button class="btn btn-entrar text-uppercase mt-3" type="submit">Enviar</button>
    </form>

</div>

<?php
require_once('rodape.php');

require_once('../rodape.php');
?>
