<div class="modal fade" id="controle-alvara" tabindex="-1" role="dialog" aria-labelledby="controle-alvara" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title text-white">Controle Alvará</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="accordionAlvara">                    
                        <div class="row my-3">
                            <div class="col-4 pr-1">
                                <div class="text-center mt-1">
                                    <button class="btn btn-info btn-block font-weight-bold btn-padrao collapsed" type="button" data-toggle="collapse" data-target="#collapseAlvara" aria-expanded="false" aria-controls="collapseAlvara">Cadastrar</button>
                                </div>
                            </div>
                            <div class="col-4 px-1">
                                <div class="text-center mt-1">
                                    <button class="btn btn-info btn-block font-weight-bold btn-padrao collapsed" type="button" data-toggle="collapse" data-target="#collapseAlvaraAnot" aria-expanded="false" aria-controls="collapseAlvaraAnot">Criar Notificação</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="collapse" id="collapseAlvaraAnot" aria-labelledby="headingThree" data-parent="#accordionAlvara">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nome-contato" class="label-cadastro">Texto da Notificação</label>
                                    <textarea class="form-control" type="text" id="" rows="4"></textarea>
                                    <div class="invalid-feedback">
                                        Campo Obrigatório
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col text-center">
                                    <h5 class="label-cadastro">Setores</h5>
                                </div>
                            </div>
                            <div class="row justify-content-around mt-3">
                                <div class="col-7">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAlvaraRh">
                                        <label class="custom-control-label font-weight-bold" for="checkAlvaraRh">RH</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAlvaraContabilidade">
                                        <label class="custom-control-label font-weight-bold" for="checkAlvaraContabilidade">Contabilidade</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAlvaraComercial">
                                        <label class="custom-control-label font-weight-bold" for="checkAlvaraComercial">Comercial</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAlvaraGestao">
                                        <label class="custom-control-label font-weight-bold" for="checkAlvaraGestao">Gestão</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAlvaraCliente">
                                        <label class="custom-control-label font-weight-bold" for="checkAlvaraCliente">Cliente</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-success font-weight-bold btn-padrao" type="submit">Enviar</button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseAlvara" aria-labelledby="headingTwo" data-parent="#accordionAlvara">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5 class="label-cadastro">CPF</h5>
                                    <h5 class="mt-1">000.000.000-00</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="label-cadastro">CNPJ</h5>
                                    <h5 class="mt-1">00.000.000/0000-00</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 class="label-cadastro">Nome</h5>
                                    <h5 class="mt-1">Lorem ipsum</h5>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-10">
                                    <h5 class="label-cadastro">Endereço</h5>
                                    <h5 class="mt-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Alvará</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Data Validade</h5>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Requerimento</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Guia Laudo</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center my-4">
                                <button class="btn btn-success font-weight-bold btn-padrao" type="submit">Salvar</button>
                            </div>
                        </div>
                    </div>
                    <!-- <form action="../controllers/contato/contato.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                        <input name="method" value="store" hidden>
                        <input name="id-usuario" value="<?=$_SESSION['id_usuario'];?>" hidden>                      
                    </form> -->
                </div>
            </div>
        </div>
    </div>