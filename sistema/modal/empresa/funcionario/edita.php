<div class="modal fade" id="edita" tabindex="-1" role="dialog" aria-labelledby="edita" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar Funcionário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa/funcionario.php" method="post" class="needs-validation-loading" novalidate autocomplete="off" >
                <input id="funcionariosId" name="funcionariosId" hidden>
                <input name="method" value="edit" hidden>
                <div class="row mt-3 mb-3">
                    <div class="col-md-5 mx-auto text-center">
                        <label class="font-weight-bold">Salário *</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                            </div>
                            <input class="text-center form-control salario-funcionario" type="text" name="salario" maxlength="2" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mx-auto text-center">
                        <div class="footer">
                            <button class="btn btn-warning btn-padrao font-weight-bold" type="submit">Editar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>