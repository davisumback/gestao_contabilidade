<div class="modal fade" id="insereFuncionario" tabindex="-1" role="dialog" aria-labelledby="insereFuncionario" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Funcionário</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa/funcionario.php" method="post" class="needs-validation-loading m-3" novalidate autocomplete="off" >
                <input id="idEmpresa" name="idEmpresa" value="<?=$_SESSION['viewIdEmpresa']?>" hidden>
                <input name="method" value="store" hidden>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="label-cadastro col-form-label">Nome *</label>
                            <input class="text-center form-control" type="text" name="nome" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-cadastro col-form-label">CPF *</label>
                            <input class="text-center form-control" type="text" id="cpf" name="cpf" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="label-cadastro col-form-label">Salário *</label>
                            <input class="text-center form-control salario-funcionario" type="text" name="salario" maxlength="2" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>

                <div class="row mb-3">
                    <div class="col-6 mx-auto text-center">
                        <div class="footer">
                            <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>