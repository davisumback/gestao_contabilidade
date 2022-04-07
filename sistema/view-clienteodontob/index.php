<?php
use App\DAO\ClienteDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-odontob/cabecalho.php');

?>

<div class="container-fluid">
    <!-- <div class="row mb-3">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-info btn-padrao font-weight-bold" data-toggle="modal" data-target="#envio-doc-extras">
                Enviar Documentos Extras
            </button>
        </div>
    </div>
    <hr> -->
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light border-danger rounded-top mb-3">
                <div class="card-header bg-danger text-white text-center font-weight-bold">Titulo</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Despesas</th>
                                    <th class="border-top-0" scope="col">03/2019</th>
                                    <th class="border-top-0" scope="col">04/2019</th>
                                    <th class="border-top-0" scope="col">05/2019</th>
                                    <th class="border-top-0" scope="col">06/2019</th>
                                    <th class="border-top-0" scope="col">07/2019</th>
                                    <th class="border-top-0" scope="col">08/2019</th>
                                    <th class="border-top-0" scope="col">09/2019</th>
                                    <th class="border-top-0" scope="col">10/2019</th>
                                    <th class="border-top-0" scope="col">11/2019</th>
                                    <th class="border-top-0" scope="col">12/2019</th>
                                    <th class="border-top-0" scope="col">01/2020</th>
                                    <th class="border-top-0" scope="col">02/2020</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Notas Recebidas</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">Recibos</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">Notas Serviços</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">PF</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">Resultado (total)</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light border-danger rounded-top mb-3">
                <div class="card-header bg-danger text-white text-center font-weight-bold">Titulo</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Mês</th>
                                    <th class="border-top-0" scope="col">Emitidos</th>
                                    <th class="border-top-0" scope="col">Saldo p/ consult + renda</th>
                                    <th class="border-top-0" scope="col">Saldo p/ consultorio + PF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">04/2019</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">03/2019</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">02/2019</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/cliente/envio-doc-extras.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>