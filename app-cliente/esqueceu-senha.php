<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="#">

	<title>Medb | Recuperar senha</title>

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

</head>

<body class="text-center foto">

		<div class="form">

			<img src="../sistema/images/logo_medb.png" class="logo-login mb-5">

			<form class="form-signin mt-5" id="teste2" action="login/login.php" method="post">

                <h5 class="texto">Nova Senha</h5>
				<input name="email" type="text" class="form-control text-center mt-3" placeholder="Email" maxlength="35" required autofocus>
				<input name="cpf" type="text" class="form-control text-center mt-3" placeholder="CPF" maxlength="35" required>
                <input name="nascimento" type="text" class="form-control text-center mt-3" placeholder="Data de Nascimento" maxlength="35" required>
				<button class="btn btn-success btn-entrar text-uppercase mt-3" type="submit" id="login-button">Ok</button>
                <button onclick="location.assign('index.php')" class="btn btn-danger btn-cancelar text-uppercase mt-3" type="button" id="login-button">Cancelar</button>

				<p class="mt-4 mb-3 text-muted">&copy; Medb</p>
			</form>
		</div>

</body>
</html>
