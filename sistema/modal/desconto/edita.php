<div class="modal fade" id="alteraDesconto" tabindex="-1" role="dialog" aria-labelledby="alteraDesconto" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Editar Desconto</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form-altera-desconto" action="../controllers/grupob/desconto.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">                    
                    <input name="id" id="id-desconto" hidden>
                    <input name="method" value="update" hidden>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="altera-nome-desconto" class="label-cadastro col-form-label">Nome</label>
                                <input name="nome" type="text" class="form-control" id="altera-nome-desconto" required>
                            </div>
                            <div class="col-6">
                                <label for="altera-valor-desconto" class="label-cadastro col-form-label">Valor</label>
                                <input name="valor" type="text" class="form-control" id="altera-valor-desconto" required>
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