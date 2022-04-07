<?php
use App\DAO\ClienteDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Controle :)");
require_once('menu-left.php');
require_once('../cabecalho.php');

// $dao = new ClienteDAO();
// $clientes = $dao->getDirecionamentoIRAll();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center border-top-0 border-left-0" scope="col">
                                        <h4 class="label-cadastro">CNPJ</h4>
                                    </th>
                                    <th class="text-center border-top-0" scope="col">
                                        <h4 class="label-cadastro">Alvará</h4>
                                    </th>
                                    <th class="text-center border-top-0" scope="col">
                                        <h4 class="label-cadastro">Acesso de Nota</h4>
                                    </th>
                                    <th class="text-center border-top-0 border-right-0" scope="col">
                                        <h4 class="label-cadastro">Finalizada</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td class="border-left-0 border-bottom-0">
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <br>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <br>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-cnpj">999</button>
                                    </td>
                                    <td class="border-left-0 border-bottom-0">
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-alvara">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-alvara">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-alvara">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-alvara">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-alvara">999</button>
                                        <br>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-alvara">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-alvara">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-alvara">999</button>
                                    </td>
                                    <td class="border-left-0 border-bottom-0 w-auto">
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-acesso">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-acesso">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-acesso">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-acesso">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-acesso">999</button>
                                    </td>
                                    <td class="border-left-0 border-right-0 border-bottom-0 w-auto">
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-finalizado">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-finalizado">999</button>
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold mt-2" data-toggle="modal" data-target="#controle-finalizado">999</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/contrato/controle-cnpj.php';?>
<?php include __DIR__ . '/../modal/contrato/controle-alvara.php';?>
<?php include __DIR__ . '/../modal/contrato/controle-acesso.php';?>
<?php include __DIR__ . '/../modal/contrato/controle-finalizado.php';?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>