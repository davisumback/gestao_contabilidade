<?php
use App\Config\ManutencaoConfig;
use App\Login\Logout;

if(ManutencaoConfig::MANUTENCAO == true){
    $_SESSION = Logout::fazLogout();

    header("Location: ../../index-manutencao.php");
    die();
}

?>

<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$header->getTitulo();?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="/sistema/images/favicon.ico">

    <?=$header->getEstilos();?>

    <?=$header->getFonts();?>

    <?php
        if (!empty($header->getScripts())){
            echo $header->getScripts();
        }
    ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>

    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default" id="navbar-bug">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#">GrupoB</a>
                <a class="navbar-brand hidden" href="#">M</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">

                <ul class="nav navbar-nav">
                    <?=$menu->getItensMenu()?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa-tasks" style="margin-top:12px;"></i></a>
                    <h5 class="titulo-navegacao"><?=$menu_topo->getTituloNavegacao();?></h5>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle avatar" src="<?=$avatar?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link gif-loading" href="form-altera-senha.php"><i class="fa fa-key" style="margin-right:10px;"></i>Alterar senha</a>
                            <a class="nav-link gif-loading" href="<?=$menu_topo->getSair();?>"><i class="fa fa-power-off" style="margin-right:10px;"></i>Sair</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <!--<div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Home</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Home</li>
                        </ol>
                    </div>
                </div>
            </div>-->
        </div>

        <div id="carregando" class="center display-none">
            <div class="loading">
            </div>
        </div>

        <div class="content mt-3" id="conteudo">
