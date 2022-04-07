<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Simulador | Resumido");
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');
?>

<form class="needs-validation-loading" action="../controllers/simulador/simula-res.php" method="post" autocomplete="off" novalidate>
	<div class="row mt-3 text-center">
		<div class="col-12 mb-3 label-cadastro">
			<label for="abertura">Faturamento Mensal</label>
			<input placeholder="" class="form-control text-center col-6 col-md-3 mx-auto" type="text" name="faturamento" id="faturamento" autofocus required="true">
            <div class="invalid-feedback">
                Obrigatório*
            </div>
		</div>
	</div>

	<div class="row mt-2 text-center">
		<div class="col-12 mb-3 label-cadastro">
			<label for="abertura">ISS</label>
			<input placeholder="2% a 5%" class="form-control text-center col-6 col-md-3 mx-auto" type="text" name="iss" id="iss" required="true">
            <div class="invalid-feedback">
                Obrigatório*
            </div>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-12 text-center">
			<button type="submit" class="btn btn-padrao btn-cor-primaria font-weight-bold">Calcular</button>
		</div>
	</div>
</form>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
	$('#faturamento').mask('000.000.000,00', {reverse: true});
	$('#iss').mask('0', {reverse: true});
	$('#meses_antecipacao').mask('0', {reverse: true});
</script>
