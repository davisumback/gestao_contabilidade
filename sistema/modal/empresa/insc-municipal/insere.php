<div class="modal fade" id="insere" tabindex="-1" role="dialog" aria-labelledby="insere" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Inscrição Municipal</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa/empresa.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="empresasId" name="empresasId" hidden>
                <input name="method" value="storeInscricaoMunicipal" hidden>
                <input name="arquivoRetorno" value="inscricao-municipal.php" hidden>
                <div class="modal-body">
                    <div class="row my-2">
                        <div class="col-12 text-center">
                            <label class="label-cadastro col-form-label text-center">Inscrição Municipal*</label>
                            <input name="inscricaoMunicipal" type="text" class="form-control" required>
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
