<div class="modal fade" id="nova-ies" tabindex="-1" role="dialog" aria-labelledby="nova-ies" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-cor-primaria">
                    <h5 class="modal-title">Cadastrar IES</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/ies/ies.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                    <input name="method" value="store" hidden>                    
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="faculdade" class="label-cadastro">IES</label>
                                        <input name="nome" type="text" class="form-control" id="faculdade" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Digite um nome de IES válido.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cidade-faculdade" class="label-cadastro">Cidade</label>
                                        <input name="cidade" type="text" class="form-control" id="cidade-faculdade" maxlength="50" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Digite uma cidade válida.
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