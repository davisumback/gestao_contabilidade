<?php
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Certificado');
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<div class="container-fluid">
    <div class="text-center mb-3">
        <button class="btn btn-padrao btn-success" data-toggle="modal" data-target="#insereCertificado">Cadastrar</button>
        <button class="btn btn-padrao btn-success">Consultar</button>
    </div>

    <?php Mensagem::getMensagem($_COOKIE, 'insercaoCertificado', 'mensagemInsercaoCertificado'); ?>
</div>

<?php include __DIR__ . '/../modal/certificado/insere.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script>
    $('#dataValidade').mask('00/00/0000');
</script>