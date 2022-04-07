<div class="modal fade" id="alteraIes" tabindex="-1" role="dialog" aria-labelledby="alteraIes" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-dark font-weight-bold">Editar IES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form-altera-ies" action="../controllers/ies/ies.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">                    
                    <input name="id" id="id-ies" hidden>
                    <input name="method" value="update" hidden>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="altera-nome-ies" class="label-cadastro col-form-label">IES</label>
                                <input name="nome" type="text" class="form-control" id="altera-nome-ies" required>
                            </div>
                            <div class="col-6">
                                <label for="altera-cidade-ies" class="label-cadastro col-form-label">Cidade</label>
                                <input name="cidade" type="text" class="form-control" id="altera-cidade-ies" required>
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