<div class="modal fade" id="novo-servico" tabindex="-1" role="dialog" aria-labelledby="novo-servico" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Cadastrar Serviço NFSe</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/servicos-nfse/servicos-nfse.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                        <input name="method" value="storeServico" hidden>                    
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="cod-servico" class="label-cadastro">Código Serviço NFSe</label>
                                        <input name="cod-servico" type="text" class="form-control valor" id="cod-servico" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Obrigatório *
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nome" class="label-cadastro">Nome</label>
                                        <input name="nome" type="text" class="form-control" id="nome" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Obrigatório *
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Cadastrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>