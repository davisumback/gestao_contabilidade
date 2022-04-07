<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Simulador");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php if(array_key_exists('erro_data', $_COOKIE)){ ?>
	<div class="text-center alert alert-danger alert-dismissible fade show alert-login mb-3" role="alert">
		<strong><?=$_COOKIE['erro_data'];?></strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php } ?>

<form class="needs-validation-loading" action="../controllers/simulador/data-range.php" method="post" id="form-abertura" autocomplete="off" novalidate>
	<input name="pasta" value="<?=$_SESSION['pasta']?>" hidden>
	<div class="row mt-3 justify-content-center">
		<div class="col-md-3">
	    	<div class="row text-center">
				<div class="col-md-12 mb-3 label-cadastro">
					<label for="abertura">Data Início</label>
					<input placeholder="mm/aaaa" class="form-control text-center" type="text" name="data_inicio" id="data_inicio" autofocus required="true">
					<div class="invalid-feedback">
						Obrigatório*
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
	    	<div class="row text-center">
				<div class="col-md-12 mb-3 label-cadastro">
					<label for="abertura">Data Fim</label>
					<input placeholder="mm/aaaa" class="form-control text-center" type="text" name="data_fim" id="data_fim" required="true">
					<div class="invalid-feedback">
						Obrigatório*
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 text-left mt-4 pt-2">
			<button type="submit" class="btn btn-success btn-padrao font-weight-bold">Prosseguir</button>
		</div>
	</div>
</form>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
	$('#data_inicio').mask('00/0000');
	$('#data_fim').mask('00/0000');
</script>
