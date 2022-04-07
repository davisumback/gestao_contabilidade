<div class="modal fade" id="novo-desconto" tabindex="-1" role="dialog" aria-labelledby="nova-desconto" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Cadastrar Desconto</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="../controllers/grupob/desconto.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                    <input name="method" value="store" hidden>
                    
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="nome-desconto" class="label-cadastro">Nome Desconto</label>
                                        <input name="nome" type="text" class="form-control" id="nome-desconto" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Campo Obrigatório.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="valor-desconto" class="label-cadastro">Valor</label>
                                        <input name="valor" type="text" class="form-control" id="valor-desconto" maxlength="50" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Campo Obrigatório.
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