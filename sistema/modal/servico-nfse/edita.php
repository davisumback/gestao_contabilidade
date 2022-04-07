<div class="modal fade" id="alteraServico" tabindex="-1" role="dialog" aria-labelledby="alteraServico" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-dark font-weight-bold">Editar Serviço NFSe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="../controllers/servicos-nfse/servicos-nfse.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">                    
                    <input name="servicoId" id="servicoId" hidden>
                    <input name="method" value="updateServico" hidden>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="cod-servico" class="label-cadastro col-form-label">Código Serviço NFSe</label>
                                <input name="cod-servico" id="cod-servico" type="text" class="form-control valor" required>
                            </div>
                            <div class="col-6">
                                <label for="nome" class="label-cadastro col-form-label">Nome</label>
                                <input name="nome" id="nome" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-padrao btn-warning font-weight-bold" type="submit">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>