<?php
require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

use App\DAO\PreEmpresaDAO;

$dao = new PreEmpresaDAO();
$quantidadePreEmpresas = $dao->getQuantidadePreEmpresas();
$quantidadeEmpresasOutroEscritorio = $dao->getQuantidadeEmpresasOutroEscritorio();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div onclick="vaiParaNovaPagina('pre-empresa-all.php')" class="card card-pipedrive bg-flat-color-2 text-light">
                <div class="card-body">
                    <div class="h4 m-0">Pré-Empresas</div>
                    <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="h4 m-0"><?=$quantidadePreEmpresas['quantidade']?></div>
                    <small class="text-light">Em processo de abertura.</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div onclick="vaiParaNovaPagina('empresa-outro-escritorio-all.php')" class="card card-pipedrive bg-flat-color-2 text-light">
                <div class="card-body">
                    <div class="h4 m-0">Empresas</div>
                    <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="h4 m-0"><?=$quantidadeEmpresasOutroEscritorio['quantidade']?></div>
                    <small class="text-light">Em processo de migração de outro escritório.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>
