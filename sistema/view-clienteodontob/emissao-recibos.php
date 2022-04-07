<?php
use App\DAO\ClienteDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-odontob/cabecalho.php');

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-danger btn-padrao font-weight-bold" data-toggle="modal" data-target="#emitir-recibo">
                Emitir Recibo
            </button>
        </div>
    </div>

    <div class="row justify-content-around mt-5">
        <div class="col-md-7 text-center">
            <div class="card bg-light border-danger rounded-top mb-3">
                <div class="card-header bg-danger text-white font-weight-bold">Valor Projetado Receita</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Competência</th>
                                    <th class="border-top-0" scope="col">Valor Despesas </th>
                                    <th class="border-top-0" scope="col">Saldo Emissão</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">04/2019</th>
                                    <td>R$ 1.000,00</td>
                                    <td>R$ 500,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">03/2019</th>
                                    <td>R$ 1.000,00</td>
                                    <td>R$ 500,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">02/2019</th>
                                    <td>R$ 1.000,00</td>
                                    <td>R$ 500,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">01/2019</th>
                                    <td>R$ 1.000,00</td>
                                    <td>R$ 500,00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/cliente/emitir-recibo.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>