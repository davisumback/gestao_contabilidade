<?php
require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

$dao = new \App\DAO\NotaDAO();
$retorno = $dao->quantidadeNotas($_SESSION['id_usuario']);
$quantidadeNotas = $retorno['quantidade'];

$dao = new \App\DAO\ProspectDAO();
$retorno = $dao->getQuantidadeProspects($_SESSION['id_usuario']);
$quantidadeProspects = $retorno['quantidade'];

$propostaMedcontabil = new \App\Model\Prospect\PropostaMedcontabil();
$retorno = $propostaMedcontabil->getQuantidadePropostasEnviadas($_SESSION['nome_completo']);
$quantidadePropostasEnviadas = $retorno['quantidade'];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('form-nota.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-marker bg-info p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-dark-blue mb-0 pt-3"><?=$quantidadeNotas?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total de Anotações</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('prospect.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-users bg-info p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-dark-blue mb-0 pt-3"><?=$quantidadeProspects?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total de Prospects</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('prospect.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-file-export bg-info p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-dark-blue mb-0 pt-3"><?=$quantidadePropostasEnviadas?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Propostas Enviadas</div>
                </div>
            </div>
        </div>
    </div>    
</div>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
?>
