<div class="modal fade" id="controle-finalizado" tabindex="-1" role="dialog" aria-labelledby="controle-finalizado" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title text-white">Controle Finalizado</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="accordionFinalizado">                    
                        <div class="row my-3">
                            <div class="col-4 pr-1">
                                <div class="text-center mt-1">
                                    <button class="btn btn-info btn-block font-weight-bold btn-padrao collapsed" type="button" data-toggle="collapse" data-target="#collapseFinalizado" aria-expanded="false" aria-controls="collapseFinalizado">Visualizar</button>
                                </div>
                            </div>
                            <div class="col-4 px-1">
                                <div class="text-center mt-1">
                                    <button class="btn btn-info btn-block font-weight-bold btn-padrao collapsed" type="button" data-toggle="collapse" data-target="#collapseFinalizadoAnot" aria-expanded="false" aria-controls="collapseFinalizadoAnot">Criar Notificação</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="collapse" id="collapseFinalizadoAnot" aria-labelledby="headingThree" data-parent="#accordionFinalizado">
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
                                        <input type="checkbox" class="custom-control-input" id="checkAcessoRh">
                                        <label class="custom-control-label font-weight-bold" for="checkAcessoRh">RH</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAcessoContabilidade">
                                        <label class="custom-control-label font-weight-bold" for="checkAcessoContabilidade">Contabilidade</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAcessoComercial">
                                        <label class="custom-control-label font-weight-bold" for="checkAcessoComercial">Comercial</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAcessoGestao">
                                        <label class="custom-control-label font-weight-bold" for="checkAcessoGestao">Gestão</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAcessoCliente">
                                        <label class="custom-control-label font-weight-bold" for="checkAcessoCliente">Cliente</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-success font-weight-bold btn-padrao" type="submit">Enviar</button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseFinalizado" aria-labelledby="headingTwo" data-parent="#accordionFinalizado">
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
                            <div class="row mt-3">
                                <div class="col-6">
                                    <h5 class="label-cadastro">CNPJ</h5>
                                    <h5 class="mt-1">00.000.000/0000-00</h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="label-cadastro">Alvará</h5>
                                    <h5 class="mt-1">0000000</h5>
                                </div>
                            </div>
                            <hr>                          
                            <div class="row my-4">                            
                                <div class="col text-center">
                                    <h3 class="label-cadastro">Acesso</h3>
                                </div>
                            </div>
                            <div class="row mt-4">                            
                                <div class="col-4">                                    
                                    <h5 class="label-cadastro">Site</h5>
                                    <a class="h5 mt-1" href="">www.google.com.br</a>                                     
                                </div>
                            </div>
                            <div class="row mt-3 mb-5">
                                <div class="col-6">
                                    <h5 class="label-cadastro">Login</h5>
                                    <h5 class="mt-1">abcde</h5>
                                </div>
                                <div class="col-6">
                                    <h5 class="label-cadastro">Senha</h5>
                                    <h5 class="mt-1">654321</h5>
                                </div>
                            </div>
                            <div class="text-center my-4">
                                <button class="btn btn-success font-weight-bold btn-padrao" type="submit">Finalizar</button>
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