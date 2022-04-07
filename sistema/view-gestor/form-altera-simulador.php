<?php

use App\DAO\SimuladorDAO;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Simulador");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php
	$meses = array();
	$id = 0;
?>

<?php
	$id_simulacao = $_SESSION['id_simulacao'];
	$simulador_dao = new SimuladorDAO();

	$resultado = $simulador_dao->getSimulacao($id_simulacao);
?>

<form class="needs-validation-loading" action="../controllers/simulador/altera-simula-com.php" method="post" autocomplete="off" novalidate>
    <div class="col-md-12 text-center mb-3">
    	<button type="submit" class="btn btn-success btn-simular">Simular novamente</button>
    	<button onclick="vaiParaNovaPagina('simulador-resultado-com.php')" class="btn btn-secondary btn-voltar">Voltar</button>
    </div>

	<?php foreach ($resultado as $resultado_array => $valor) : ?>
		<?php
		 	$mes_ano = strtolower($valor['mes']) . '-' . $valor['ano'];
			array_push($meses, $mes_ano);
		?>

		<div class="col-md-4">
            <div class="card simulador-card">
                <div class="card-header simulador-card-header">
                    <strong class="card-title pl-2"><?=ucfirst($mes_ano)?></strong>
                </div>
                <div class="card-body">
                    <div class="mx-auto d-block">
						<input name="id_simulacao-<?=$id?>" value="<?=$id_simulacao?>" hidden>

						<h6 class="text-sm-left mt-2 mb-1">Faturamento</h6>
						<input value="<?=$valor['faturamento']?>" class="form-control" type="text" id="<?='fat-'.$mes_ano?>" name="<?='fat-'.$mes_ano?>" onfocus="projeta(<?=$id?>)">

						<h6 class="text-sm-left mt-2 mb-1">Pró-labore</h6>
						<input value="<?=$valor['prolabore']?>" class="form-control" type="text" id="<?='pro-'.$mes_ano?>" name="<?='pro-'.$mes_ano?>" onfocus="projeta(<?=$id?>)">
						<?php
							$explode = explode('-',$mes_ano);
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
</form>


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
	<?php foreach ($resultado as $resultado_array => $valor) : ?>
		<?php $mes_ano = strtolower($valor['mes']) . '-' . $valor['ano']; ?>
		jQuery('#fat-<?=$mes_ano?>').mask('000.000.000,00', {reverse: true});
		jQuery('#pro-<?=$mes_ano?>').mask('000.000.000,00', {reverse: true});
		jQuery('#cpp-<?=$mes_ano?>').mask('000.000.000,00', {reverse: true});
	<?php endforeach ?>

</script>
