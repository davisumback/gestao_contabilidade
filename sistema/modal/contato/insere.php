<div class="modal fade" id="novo-contato" tabindex="-1" role="dialog" aria-labelledby="novo-contato" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Cadastrar Contato</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/contato/contato.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                    <input name="method" value="store" hidden>
                    <input name="id-usuario" value="<?=$_SESSION['id_usuario'];?>" hidden>                    
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="nome-contato" class="label-cadastro">Nome Contato</label>
                                        <input name="nome" type="text" class="form-control" id="nome-contato" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Campo Obrigatório
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email-contato" class="label-cadastro">Email</label>
                                        <input name="email" type="text" class="form-control" id="email-contato" maxlength="50" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Campo Obrigatório
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefone-contato" class="label-cadastro">Telefone</label>
                                        <input name="telefone" type="text" class="form-control" id="telefone-contato" maxlength="50" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Campo Obrigatório
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-padrao btn-success font-weight-bold" type="submit">Cadastrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>