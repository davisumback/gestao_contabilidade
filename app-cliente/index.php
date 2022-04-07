<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="#">

	<title>Medb | Login</title>

	<!-- Bootstrap core CSS -->
	<!--<link href="bootstrap-4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

	<!-- Custom styles for this template -->
	<link href="css/index.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>

</head>

<body class="text-center">
		<div class="form">

			<?php if(array_key_exists('login_invalido', $_COOKIE) && $_COOKIE['login_invalido'] == "true"){ ?>
				<div class="text-center alert alert-warning alert-dismissible fade show alert-login mb-5" role="alert">
					<strong><?=$_COOKIE['mensagem_login_invalido'];?></strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php } ?>

			<?php if(array_key_exists('usuario_inativo', $_COOKIE) && $_COOKIE['usuario_inativo'] == "true"){ ?>
				<div class="text-center alert alert-danger alert-dismissible fade show alert-login mb-5" role="alert">
					<strong><?=$_COOKIE['mensagem_usuario_inativo'];?></strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php } ?>

			<?php if(array_key_exists('permissao', $_COOKIE) && $_COOKIE['permissao'] == "true"){ ?>
				<div class="text-center alert alert-warning alert-dismissible fade show alert-login mb-5" role="alert">
					<strong><?=$_COOKIE['mensagem_permissao'];?></strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php } ?>

			<img src="../sistema/images/logo_medb.png" class="logo-login mb-5">

			<form class="form-signin mt-5 needs-validation" id="formulario" action="login/login.php" method="post" novalidate autocomplete="off">
				<input id="cpf" name="cpf" type="text" class="form-control text-center mt-3" placeholder="CPF" maxlength="15" required autofocus>
				<div class="invalid-feedback">
		            Digite um CPF válido.
		        </div>

				<input name="senha" type="password" class="form-control text-center mt-3" placeholder="Senha" maxlength="35" required>
				<div class="invalid-feedback">
		            Digite uma senha válida.
		        </div>

				<button class="btn btn-success btn-entrar text-uppercase mt-3" type="submit" id="login-button">Ok</button>

                <div class="mt-4 mb-3 esqueceu-senha">
                    <a href="esqueceu-senha.php">Esqueceu a senha?</a>
                </div>

				<p class="mt-5 mb-2 text-muted">&copy; Medb</p>
			</form>
		</div>

	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}else{
							event.preventDefault();

							$('#formulario').css('opacity', '0');
							$('img').addClass('form-success');

							setTimeout( function () {
								$('#formulario').submit();
							}, 2000);
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();

		$("#cpf").mask("000.000.000-00", {reverse: true});
	</script>

</body>
</html>
