<?php

use App\DAO\IesDAO;
use App\DAO\PlanoDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');

if(!array_key_exists('cliente_pre_cadastro', $_SESSION)) {
	header("Location: form-pre-cliente.php");
	die();
}

$menu_topo->setTituloNavegacao("Pré Cadastro Cliente");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php
$ies_dao = new IesDAO();
$ies_array = $ies_dao->getTodasIes();

$dadosCpf = json_decode($_SESSION['cliente_pre_cadastro'], true);
?>

<div class="container-fluid">
	<div class="row mt-5">
		<div class="col-md-10 offset-md-1">
			<form action="../controllers/pre-cliente/insere-pre-cadastro.php" method="POST" class="needs-validation-loading" novalidate autocomplete="off">
				<input name="situacao_cadastral" value="<?=$dadosCpf['situacao']?>" hidden>
				<input name="id_usuario" value="<?=$_SESSION['id_usuario']?>" hidden>

				<div class="row">
					<div class="col-md-6 mb-3 label-cadastro">
						<label for="cpf">CPF *</label>
						<input value="<?=$dadosCpf['cpf']?>" name="cpf" type="text" class="form-control col-12 col-md-6" id="cpf" required>
						<div class="invalid-feedback">
							Obrigatório
						</div>
					</div>

					<div class="col-md-6 mb-3 label-cadastro">
						<label for="mae">Mãe *</label>
						<input value="<?=$dadosCpf['mae']?>" name="mae" type="text" class="form-control col-12 col-md-6" id="mae" required>
						<div class="invalid-feedback">
							Obrigatório
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mb-3 label-cadastro">
						<label for="nome">Nome *</label>
						<input value="<?=$dadosCpf['nome']?>" name="nome" type="text" class="form-control col-12" id="nome" required>
						<div class="invalid-feedback">
							Obrigatório
						</div>
					</div>

					<div class="col-md-6 mb-3 label-cadastro">
						<label for="situacao">Situação Cadastral *</label>
						<input value="<?=$dadosCpf['situacao']?>" name="situacao_cadastral" type="text" class="form-control col-12" id="situacao" required readonly>
						<div class="invalid-feedback">
							Obrigatório
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mb-3 label-cadastro">
						<label for="email">Email *</label>
						<input name="email" type="email" class="form-control" id="email" placeholder="exemplo@exemplo.com" maxlength="50" required autofocus autocomplete="none">
						<div class="invalid-feedback">
							Digite um email válido.
						</div>
					</div>

					<div class="col-md-6 mb-3 label-cadastro">
						<label for="nascimento">Data de nascimento *</label>
						<input type="text" value="<?=$dadosCpf['nascimento']?>" name="data_nascimento" class="form-control col-md-6" id="nascimento" required>
						<div class="invalid-feedback">
							Digite uma data de nascimento válida.
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mb-3 label-cadastro" type="text">
						<label for="faculdade">IES *</label>
						<select name="ies_id" class="custom-select d-block w-100" id="faculdade" required>
							<option value="">Escolha...</option>
							<?php foreach ($ies_array as $ies) : ?>
								<option value="<?=$ies['id']?>"><?=$ies['nome'].' - '.$ies['cidade']?></option>
							<?php endforeach ?>
						</select>
						<div class="invalid-feedback">
							Escolha um plano.
						</div>
					</div>

					<div class="col-md-6 mb-3 label-cadastro">
						<label for="crm">CRM</label>
						<input name="crm" type="text" class="form-control" id="crm" maxlength="20" required>
						<div class="invalid-feedback">
							Digite um CRM válido.
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mb-3 label-cadastro">
						<label for="telefone-celular">Telefone Celular *</label>
						<input name="telefone_celular" type="text" class="col-md-6 form-control" id="telefone-celular" required autocomplete="none">
						<div class="invalid-feedback">
							Digite um número de telefone válido.
						</div>
					</div>

					<div class="col-md-6 mb-3 label-cadastro">
						<label for="telefone-comercial">Telefone Comercial</label>
						<input name="telefone_comercial" type="text" class="form-control col-md-6" id="telefone-comercial" autocomplete="none">
						<div class="invalid-feedback">
							Digite um número válido.
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mb-3 label-cadastro">
						<label for="vencimento-mensalidade">Vencimento da primeira mensalidade*</label>
						<input name="vencimento_mensalidade" type="date" class="form-control col-md-6" id="vencimento-mensalidade" placeholder="" min="2017-01-01" required>
						<div class="invalid-feedback">
							Digite uma data de vencimento válida.
						</div>
					</div>
				</div>

				<div class="text-center mb-5 mt-4">
					<button class="btn btn-cadastrar" type="submit">Cadastrar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
	$("#nascimento").mask("00/00/0000");
	$("#telefone-celular").mask("(00) 00000-0000");
	$("#telefone-comercial").mask("(00) 0000-0000");
	$("#cpf").mask("000.000.000-00", {reverse: true});
</script>
