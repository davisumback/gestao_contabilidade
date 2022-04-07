<?php
use App\DAO\ClienteDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new ClienteDAO();
$retorno = $dao->getQuantidadeDirecionamentoIR();
$quantidade = $retorno['quantidade'];

?>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <div class="card card-pipedrive" onclick="vaiParaNovaPagina('direcionamento-ir.php')">
                <div class="card-body p-0 clearfix">
                    <i class="fa fa-laptop bg-info p-4 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-info mb-0 pt-3"><?=$quantidade?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Clientes que já responderam I.R</div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>