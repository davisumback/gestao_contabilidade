<?php
use App\DAO\ClienteDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-odontob/cabecalho.php');
?>

<div class="container-fluid">
    <div class="row justify-content-around mt-3">
        <div class="col-md-10">
            <div class="card bg-light border-danger rounded-top mb-3">
                <div class="card-header bg-danger text-white text-center label-cadastro">Renda</div>
                <div class="card-body">
                    <form action="" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0 label-cadastro" scope="col">Meses Exercício</th>
                                                    <th class="border-top-0 label-cadastro" scope="col">Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">01/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">02/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>                                                           
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">03/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">04/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">05/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">06/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">07/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">08/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">09/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">10/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">11/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">12/2019</th>
                                                    <td class="p-1">
                                                        <input class="form-control col-6" type="text" name="email" maxlength="25" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                      
                                </div>                                                
                            </div>
                            <div class="row my-3">
                                <div class="col-md-3">
                                    <label for="certificadoArquivo" class="label-cadastro col-form-label">Líquido Desejado</label>
                                    <input class="form-control" type="text" name="email" maxlength="25" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="certificadoArquivo" class="label-cadastro col-form-label">Previsão Impostos s/ Renda</label>
                                    <input class="form-control" type="text" name="email" maxlength="25" readonly>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success btn-padrao font-weight-bold">Salvar</button>
                                </div>
                            </div>
                        </div>                       
                    </form>
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