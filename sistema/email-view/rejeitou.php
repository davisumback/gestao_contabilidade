<?php
    if(!array_key_exists('resultado', $_GET) || !array_key_exists('unassigned', $_GET)){
        header("Location: http://gmail.com.br/");
        die();
    }

    use App\DAO\PropostaDAO;

    require_once('../../vendor/autoload.php');
    require_once('../../banco/conecta-medb.php');
    //require_once('../helper/helpers.php');

    $proposta_dao = new PropostaDAO($conexao);
    $retorno = $proposta_dao->verificaAceiteProposta($_GET['unassigned']);

    if($retorno['aceitou'] == 1){//redirecionar para o login do cliente
        header("Location: http://facebook.com.br/");
        die();
    }

    $cpf_cliente = md5($retorno['cpf_cliente']);

    if ($cpf_cliente == $_GET['resultado']){
        $retorno_aceite = $proposta_dao->alteraAceiteProposta(0, $retorno['cpf_cliente']);
    }else { // deu erro no hash
        header("Location: http://medb.com.br/");
        die();
    }

?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Thiago Gabriel Valente Gaia Lima">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Medb</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="email-view.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body class="text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Medb | <span class="sub-brand">Contabilidade e Finanças</span></h3>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading">Que pena!</h1>
            <p class="lead">O que aconteceu para você não aceitar nossa proposta? Se preferir nos explicar os motivos agora, entre em contato com a gente.</p>
            <p class="lead">(44) 3031-1015</p>
            <p class="lead">
                Senão, em breve ligaremos para você &nbsp ;&nbsp)
            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">

            </div>
        </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
