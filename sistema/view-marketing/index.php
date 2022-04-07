<?php
require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

use App\Model\Campanha;

$dao = new \App\DAO\ProspectDAO();
$retorno = $dao->prospectQuantidadeAll();
$quantidadeProspects = $retorno['quantidade'];

$dao = new \App\Model\Marketing\Newsletter();
$retorno = $dao->getAllQtd();
$quantidadeNewsletter = $retorno['quantidade'];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('prospect.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-users bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria mb-0 pt-3"><?=$quantidadeProspects?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Prospects</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('lista-newsletter.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-newspaper bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria mb-0 pt-3"><?=$quantidadeNewsletter?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Emails Newsletter</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>
