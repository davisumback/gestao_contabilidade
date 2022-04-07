<div class="modal fade" id="insere-novo-cnae" tabindex="-1" role="dialog" aria-labelledby="insere-conta-bancaria" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Novo CNAE</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa/cnae.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id='empresas-id' name="empresasId" value="<?=$empresaId?>" hidden>
                <input id='principal' name="principal" value="NAO" hidden>
                <input name="method" value="store" hidden>
                <input name="arquivoRetorno" value="<?=$arquivoRetorno?>" hidden>

                <div class="modal-body">

                    <div class="row mb-3 justify-content-around">
                        <div class="col-5 text-center">
                            <label for="email" class="label-cadastro col-form-label">CNAE</label>
                            <input class="form-control" name="cnae" id="cnae" type="text" required maxlength="10">
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="label-cadastro" for="exampleFormControlSelect2">Descrição</label>
                                <div class="autocomplete">
                                    <input name="descricao" class="form-control" type="text" id="input-banco" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    
                </div>

                <div class="modal-footer">
                    <button class="btn btn-cor-primaria btn-padrao" type="submit"><strong>Salvar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>
