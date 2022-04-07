<?php
use App\DAO\ClienteDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-odontob/cabecalho.php');
?>

<div class="container-fluid">
    <div class="row justify-content-around">
        <div class="col-md-10">
            <div class="card bg-light border-danger rounded-top mb-3">
                <div class="card-header bg-danger text-white text-center font-weight-bold">Enviar Documentos Extras</div>
                <div class="card-body">
                    <form action="" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="" class="label-cadastro col-form-label">Escolher Arquivos</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="upload-arquivo">
                                        <label class="custom-file-label" for="upload-arquivo"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="label-cadastro col-form-label">CPF</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="label-cadastro col-form-label">CNPJ</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="label-cadastro col-form-label">Tipo</label>
                                        <select class="custom-select" id="">
                                            <option>Escolher...</option>
                                            <option>Recibo</option>
                                            <option>NFse</option>
                                        </select>
                                    </div>                        
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="label-cadastro col-form-label">Valor</label>
                                        <input type="text" class="form-control" id="">
                                    </div>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="" class="label-cadastro col-form-label">Descrição</label>
                                        <textarea class="form-control" id="" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-success btn-padrao font-weight-bold">Enviar</button>
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