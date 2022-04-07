<div class="modal fade" id="insere-conta-bancaria" tabindex="-1" role="dialog" aria-labelledby="insere-conta-bancaria" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Conta Bancária</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa/conta-bancaria.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id='empresas-id' name="empresasId" value="<?=$empresaId?>" hidden>
                <input name="method" value="store" hidden>
                <input name="arquivoRetorno" value="<?=$arquivoRetorno?>" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="label-cadastro" for="exampleFormControlSelect2">Escolha o Banco</label>
                                <div class="autocomplete">
                                    <input name="banco" class="form-control" type="text" id="input-banco" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-4">
                            <label for="email" class="label-cadastro col-form-label">Agência</label>
                            <input name="agencia" type="text" class="form-control" required maxlength="10">
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="email" class="label-cadastro col-form-label">Conta</label>
                            <div class="input-group">
                                <input name="conta" type="text" class="form-control col-8" maxlength="10" required>
                                <span class="mt-1 px-1"><strong> - </strong></span>
                                <input name="digito" type="text" class="form-control col-3" maxlength="3" required>
                                <div class="invalid-feedback">
                                    Obrigatório *
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="label-cadastro" for="">Tipo da conta</label>
                            <div class="input-group mb-3">
                                <select name="tipo" class="custom-select" id="inputGroupSelect01" required>
                                    <option value="" selected>Escolha...</option>
                                    <option value="C">Conta Corrente</option>
                                    <option value="P">Poupança</option>
                                </select>
                                <div class="invalid-feedback">
                                    Obrigatório *
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="label-cadastro" for="">Categoria</label>
                            <div class="input-group mb-3">
                                <select name="categoria" class="custom-select" id="inputGroupSelect01" required>
                                    <option value="" selected>Escolha...</option>
                                    <option value="PF">Pessoa Física</option>
                                    <option value="PJ">Pessoa Jurídica</option>
                                </select>
                                <div class="invalid-feedback">
                                    Obrigatório *
                                </div>
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
