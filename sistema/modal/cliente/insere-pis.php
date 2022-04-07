<div class="modal fade" id="inserePis" tabindex="-1" role="dialog" aria-labelledby="inserePis" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar PIS</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/cliente/insere-pis.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="clientesId" name="clientesId" hidden>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-6 mx-auto text-center">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Número *</label>
                            <input class="text-center form-control" type="text" name="pis" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>                   
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
