<!doctype html>
<html>
<head>
<meta charset="utf-8">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Medb">
    <meta name="author" content="Thiago Gabriel">

    <title>Medb | Área Restrita</title>

    <link rel="icon" href="sistema/images/favicon.ico">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="login/css/index.css" rel="stylesheet" type="text/css">
    <link href="login/css/load.css" rel="stylesheet" type="text/css">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


  </head>
</head>

<body class="text-center">
    <div id="loading" class="center" hidden>
        <div class="carregando">
        </div>
    </div>

	<div class="form" id="body">
		<img src="login/img/logo-medb.png" class="logo-login mb-5">

    <?php if (array_key_exists('login_invalido', $_COOKIE) && $_COOKIE['login_invalido'] == "true") : ?>
      <div class="alert alert-warning alert-dismissible fade show alert-login" role="alert">
        <strong><?=$_COOKIE['mensagem_login_invalido']?></strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif ?>

    <?php if (array_key_exists('usuario_inativo', $_COOKIE) && $_COOKIE['usuario_inativo'] == "true") : ?>
      <div class="alert alert-warning alert-dismissible fade show alert-login" role="alert">
        <strong><?=$_COOKIE['mensagem_usuario_inativo']?></strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif ?>

    <?php if (array_key_exists('retorno_sessao', $_COOKIE) && $_COOKIE['retorno_sessao'] == "true") : ?>
      <div class="alert alert-warning alert-dismissible fade show alert-login" role="alert">
        <strong><?=$_COOKIE['mensagem_sessao']?></strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif ?>

		<form class="form-signin mt-5" action="login/login.php" method="post">
			<!--<i class="material-icons" style="color:#388E3C;font-size:100px;">business_center</i>!-->
			<input id="usuario" type="text" class="form-control text-center mt-3" placeholder="Usuário" maxlength="35" required autofocus>
			<input id="senha" type="password" class="form-control text-center mt-3" placeholder="Senha" maxlength="35" required>
			<button class="btn btn-success btn-entrar text-uppercase mt-3" type="button" onclick="tentaLogar()">Ok</button>

			<p class="mt-4 mb-3 text-muted">&copy; Medb</p>
		</form>
	</div>

    <script type="text/javascript">
        var body = document.getElementById("body");
        var carregando = document.getElementById("loading");
        var usuario = document.getElementById("usuario");
        var senha = document.getElementById("senha");

        var usuarioObjeto = {};

        function tentaLogar(){
            body.className = 'form cor-fundo';
            carregando.removeAttribute('hidden');

            var xhttp = new XMLHttpRequest();

            xhttp.open("POST", "web-api/login/", true);
            xhttp.setRequestHeader("Content-type", "aplication/json");

            usuarioObjeto['usuario'] = usuario.value;
            usuarioObjeto['senha'] = senha.value;

            var jsonParaEnviar = JSON.stringify(usuarioObjeto);

            xhttp.send(jsonParaEnviar);

            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    trataResultado(this.responseText);
                }
            }
        }

        function trataResultado(resposta){
            if(resposta == 'true'){
                location.href = 'http://google.com.br';
            }else {
                location.href = 'http://google.com.br?deuruim=true';            
            }
        }
    </script>

</body>

</html>
