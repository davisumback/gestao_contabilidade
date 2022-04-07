<div class="modal fade" id="insereAcesso" tabindex="-1" role="dialog" aria-labelledby="inserePis" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Acesso</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa/acesso.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="empresasId" name="empresasId" hidden>
                <input name="method" value="storeAcessos" hidden>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6 mx-auto text-center">
                            <label for="" class="label-cadastro col-form-label">Login</label>
                            <div class="input-group">
                                <input class="text-center form-control" type="text" name="login" maxlength="25" required>
                                <div class="invalid-feedback">
                                    Obrigatório *
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mx-auto text-center">
                            <label for="" class="label-cadastro col-form-label">Senha</label>
                            <div class="input-group">
                                <input class="text-center form-control" type="text" name="senha" maxlength="25" required>
                                <div class="invalid-feedback">
                                    Obrigatório *
                                </div>
                            </div>
                        </div>                      
                    </div>
                    <div class="row mb-3">
                        <div class="col text-center">
                            <label for="" class="label-cadastro col-form-label">Site</label>
                            <div class="input-group">
                                <input class="text-center form-control" type="text" name="site" maxlength="50" required>
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