<?php
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Reenvio de E-mail");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<div class="container">
   <div class="alert alert-light text-center pt-4 pb-4" role="alert">
      <h6 class="label-cadastro">Reenvio de e-mail das guias mensais na competência <strong class="text-secondary"><?= $_SESSION['dataCompetenciaView'] ?></strong>.</h6>
   </div>

   <?= Mensagem::getMensagem($_COOKIE, 'reenvioEmail', 'mensagemReenvioEmail'); ?>

   <!-- <div class="text-center mt-2"> -->
      <form class="form-signin needs-validation-loading text-center" action="../controllers/email/email.php" method="post" novalidate autocomplete="off">
            <input name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>" hidden>
            <input name="pasta" value="<?= $_SESSION['pasta'] ?>" hidden>
            <input name="competencia" value="<?= $_SESSION['dataCompetencia'] ?>" hidden>
            <input name="method" value="reenvioEmail" hidden>
            <label class=" label-cadastro">Empresa</label>
            <input name="empresasId" type="text" class="form-control text-center" maxlength="4" required autofocus>
            <button class="btn btn-success btn-padrao font-weight-bold mt-2" type="submit">Reenviar</button>
      </form>
   <!-- </div> -->
</div>
<?php
require_once('rodape.php');
require_once('../rodape.php');
?>