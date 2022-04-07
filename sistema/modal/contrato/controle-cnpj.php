<div class="modal fade" id="controle-cnpj" tabindex="-1" role="dialog" aria-labelledby="controle-cnpj" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title text-white">Controle CNPJ</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="accordionCnpj">                    
                        <div class="row my-3">
                            <div class="col-4 pr-1">
                                <div class="text-center mt-1">
                                    <button class="btn btn-info btn-block font-weight-bold btn-padrao collapsed" type="button" data-toggle="collapse" data-target="#collapseCnpj" aria-expanded="false" aria-controls="collapseCnpj">Cadastrar</button>
                                </div>
                            </div>
                            <div class="col-4 px-1">
                                <div class="text-center mt-1">
                                    <button class="btn btn-info btn-block font-weight-bold btn-padrao collapsed" type="button" data-toggle="collapse" data-target="#collapseCnpjAnot" aria-expanded="false" aria-controls="collapseCnpjAnot">Criar Notificação</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="collapse" id="collapseCnpjAnot" aria-labelledby="headingThree" data-parent="#accordionCnpj">
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
                                        <input type="checkbox" class="custom-control-input" id="checkCnpjRh">
                                        <label class="custom-control-label font-weight-bold" for="checkCnpjRh">RH</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkCnpjContabilidade">
                                        <label class="custom-control-label font-weight-bold" for="checkCnpjContabilidade">Contabilidade</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkCnpjComercial">
                                        <label class="custom-control-label font-weight-bold" for="checkCnpjComercial">Comercial</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkCnpjGestao">
                                        <label class="custom-control-label font-weight-bold" for="checkCnpjGestao">Gestão</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkCnpjCliente">
                                        <label class="custom-control-label font-weight-bold" for="checkCnpjCliente">Cliente</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-success font-weight-bold btn-padrao" type="submit">Enviar</button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCnpj" aria-labelledby="headingTwo" data-parent="#accordionCnpj">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="label-cadastro">Nome</h5>
                                    <h5 class="mt-1">Lorem ipsum</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="label-cadastro">CPF</h5>
                                    <h5 class="mt-1">000.000.000-00</h5>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-10">
                                    <h5 class="label-cadastro">Endereço</h5>
                                    <h5 class="mt-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">CNPJ</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Viabilidade</h5>
                                    <input type="email" class="form-control" id="">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Enquadramento</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">DBE</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">DARF</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Capa do Processo</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Guia</h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="label-cadastro mb-1">Contrato Social</h5>
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