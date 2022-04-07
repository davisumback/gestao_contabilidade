<?php
use App\Config\ManutencaoConfig;
use App\Helper\Mensagem;

include __DIR__ . '/vendor/autoload.php';

$auth = new \App\Model\Usuario\Auth();
$auth->sessionVerify();

if (ManutencaoConfig::MANUTENCAO == true) {
    header("Location: index-manutencao.php");
    die();
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="GrupoB">
    <meta name="author" content="Thiago Gabriel">

    <title>GrupoB | Área Restrita</title>

    <link rel="icon" href="sistema/images/favicon.ico">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="login/css/index.css" rel="stylesheet" type="text/css">
    <link href="sistema/assets/custom-css/loading.css" rel="stylesheet" type="text/css">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


  </head>
</head>

<body class="text-center">
    <div id="carregando" class="center display-none">
        <div class="loading">
        </div>
    </div>

	<div class="form" id="conteudo">
		<img src="sistema/images/logo_grupob.png" class="logo-login mb-5">

        <?= Mensagem::getMensagem($_COOKIE, 'login_valido', 'mensagem_login_invalido'); ?>
        <?= Mensagem::getMensagem($_COOKIE, 'usuario_ativo', 'mensagem_usuario_inativo'); ?>
        <?= Mensagem::getMensagem($_COOKIE, 'retorno_sessao', 'mensagem_sessao'); ?>

		<form class="form-signin mt-4 needs-validation-loading gif-loading-form" action="login/login.php" method="post" novalidate>
			<!--<i class="material-icons" style="color:#388E3C;font-size:100px;">business_center</i>!-->
			<input name="usuario" type="text" class="form-control text-center mt-3" placeholder="Usuário" maxlength="35" required autofocus>
            <div class="invalid-feedback">
                Obrigatório.
            </div>

			<input name="senha" type="password" class="form-control text-center mt-3" placeholder="Senha" maxlength="35" required>
            <div class="invalid-feedback">
                Obrigatório.
            </div>
			<button class="btn btn-success btn-entrar text-uppercase mt-3" type="submit">Ok</button>

			<p class="mt-4 mb-3 text-muted">&copy; GrupoB</p>
		</form>
	</div>

    <script src="sistema/assets/custom-js/loading-automatico.js" charset="utf-8"></script>

</body>
</html>
