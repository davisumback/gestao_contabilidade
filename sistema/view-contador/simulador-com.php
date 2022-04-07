<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Simulador");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php
	if(array_key_exists('intervalo', $_COOKIE)) {
		$intervalo = json_decode($_COOKIE['intervalo'], true);
	}
?>

<?php if(!empty($intervalo)) : ?>

	<?php
		$meses = array();
		$id = 0;
	?>

	<?php
		$id_simulacao = uniqid();
		$_SESSION['id_simulacao'] = $id_simulacao;
	?>

	<form class="needs-validation-loading" action="../controllers/simulador/simula-com.php" method="post" id="simulador-form" autocomplete="off" novalidate>
        <div class="col-md-12 text-center mb-3">
            <button type="submit" class="btn btn-success btn-simular">Simular</button>
            <button type="button" onclick="vaiParaNovaPagina('form-simulador-com.php')" class="btn btn-secondary btn-voltar">Voltar</button>
        </div>

		<?php foreach ($intervalo as $array_data => $data) : ?>
			<?php array_push($meses, $data[1]); ?>

			<div class="col-md-4">
	            <div class="card simulador-card">
	                <div class="card-header simulador-card-header">
	                    <strong class="card-title pl-2"><?=$data[0]?></strong>
	                </div>
	                <div class="card-body">
	                    <div class="mx-auto d-block">
							<input name="id_simulacao-<?=$id?>" value="<?=$id_simulacao?>" hidden>

							<h6 class="text-sm-left mt-2 mb-1">Faturamento</h6>
							<input class="form-control" type="text" id="<?='fat-'.$data[1]?>" name="<?='fat-'.$data[1]?>" onfocus="projeta(<?=$id?>)" required="true">
                            <div class="invalid-feedback">
        						Obrigatório*
        					</div>

							<h6 class="text-sm-left mt-2 mb-1">Pró-labore</h6>
							<input class="form-control" type="text" id="<?='pro-'.$data[1]?>" name="<?='pro-'.$data[1]?>" onfocus="projeta(<?=$id?>)" required="true">
                            <div class="invalid-feedback">
        						Obrigatório*
        					</div>
							<?php
								$explode = explode('-',$data[1]);
								$mes = $explode[0];
								$ano = $explode[1];
							?>
							<input name="mes-<?=$id?>" value="<?=$mes?>" hidden>
							<input name="ano-<?=$id?>" value="<?=$ano?>" hidden>
	                    </div>
	                </div>
	            </div>
	        </div>

			<?php $id++; ?>
		<?php endforeach ?>
	<?php endif ?>
</form>

<script type="text/javascript">
    function vaiParaNovaPagina(caminho){
        mostraGifLoading();
        location.assign(caminho);
    }
</script>

<script type="text/javascript">
	var meses = [];

	<?php foreach ($meses as $chave => $mes) : ?>
		meses.push('<?=$mes?>');
	<?php endforeach ?>

	function projeta(posicao){
		var primeiroMesPro = document.getElementById("pro-" + meses[posicao]);
		primeiroMesPro.addEventListener("keyup", function(){
			for (var i = posicao; i < meses.length; i++) {
				var mes = document.getElementById("pro-"+meses[i]);
				mes.value = primeiroMesPro.value;
			}
		});

		var primeiroMesFat = document.getElementById("fat-" + meses[posicao]);
		primeiroMesFat.addEventListener("keyup", function(){
			for (var i = posicao; i < meses.length; i++) {
				var mes = document.getElementById("fat-"+meses[i]);
				mes.value = primeiroMesFat.value;
			}
		});
	}
</script>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
	<?php foreach ($intervalo as $array_data => $data) : ?>
		jQuery('#fat-<?=$data[1]?>').mask('000.000.000,00', {reverse: true});
		jQuery('#pro-<?=$data[1]?>').mask('000.000.000,00', {reverse: true});
		jQuery('#cpp-<?=$data[1]?>').mask('000.000.000,00', {reverse: true});
	<?php endforeach ?>

</script>
