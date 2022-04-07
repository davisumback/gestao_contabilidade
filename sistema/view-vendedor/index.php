<?php
require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

use App\DAO\VendedorDAO;
use App\DAO\ClienteDAO;
use App\DAO\PreEmpresaDAO;

$vendedorDao = new VendedorDAO();
$numeroNotas = $vendedorDao->getNumeroNotas($_SESSION['id_usuario']);
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');
$numeroNotasHoje = $vendedorDao->getNumeroNotasPorData($_SESSION['id_usuario'], $data);

$dao = new ClienteDAO();
$clienteAconfirmar = $dao->getQuantidadeClienteAConfirmarPipedrive();

$dao = new PreEmpresaDAO();
$sociosAIncluir = $dao->getQuantidadeSociosAIncluirPipedrive('LTDA');

$dao = new \App\DAO\ContatoSiteDAO();
$quantidadeNaoAtendidos = $dao->getQuantidadeContatos($_SESSION['id_usuario'], 'MEDCONTABIL', 'NAO');

$dao = new \App\DAO\ProspectDAO();
$retorno = $dao->prospectQuantidadePorUsuario($_SESSION['id_usuario']);
$quantidadeProspects = $retorno['quantidade'];

$propostaMedcontabil = new \App\Model\Prospect\PropostaMedcontabil();
$retorno = $propostaMedcontabil->getQuantidadePropostasEnviadas($_SESSION['nome_completo']);
$quantidadePropostasEnviadas = $retorno['quantidade'];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('contato-site.php?contatos=naoAtendidos')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-user-slash bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria pt-3 mb-0"><?=$quantidadeNaoAtendidos?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Contatos não atendidos</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('pipedrive-clientes.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-user-clock bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria mb-0 pt-3"><?=$clienteAconfirmar['quantidade']?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Clientes pendentes</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('pipedrive-socios.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-user-clock bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria mb-0 pt-3"><?=$sociosAIncluir['quantidade']?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Sócios pendetes de inclusão</div>
                </div>
            </div>
        </div>
    </div>    

    <div class="row">
        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('form-nota.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-marker bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria mb-0 pt-3"><?=$numeroNotas['quantidade']?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Anotações</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('prospect.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-users bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria mb-0 pt-3"><?=$quantidadeProspects?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Prospects Medcontabil</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('prospect.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-file-export bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria mb-0 pt-3"><?=$quantidadePropostasEnviadas?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Propostas Enviadas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-anotacao-index" style="cursor:pointer;" onclick="vaiParaNovaPagina('pre-cadastro.php')">
                <div class="card-body p-0 clearfix">
                    <i class="h4 mb-0 fas fa-exclamation bg-cor-secundaria p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 cor-secundaria mb-0 pt-3"><?=$quantidadePropostasEnviadas?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Pré Cadastro</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>
