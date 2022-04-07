<div class="modal fade" id="edita-cnae" tabindex="-1" role="dialog" aria-labelledby="edita-email" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <h5 class="modal-title text-dark">Editar CNAE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa/cnae.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id='empresas-id' name="empresasId" value="<?=$empresaId?>" hidden>
                <input name="arquivoRetorno" value="<?=$arquivoRetorno?>" hidden>
                <input name="id" id="idCnae" value="" hidden>
                <input name="method" value="update" hidden>

                <div class="modal-body">

                    <div class="row mb-3 justify-content-around">
                        <div class="col-5 text-center">
                            <label for="email" class="col-form-label font-weight-bold">CNAE</label>
                            <input class="form-control cnae" name="cnae" id="editaCnae" type="text" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold" for="exampleFormControlSelect2">Descrição</label>
                                <div class="autocomplete">
                                    <input name="descricao" class="form-control" type="text" id="descricao" required>
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