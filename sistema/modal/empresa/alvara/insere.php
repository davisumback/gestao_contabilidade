<div class="modal fade" id="insere" tabindex="-1" role="dialog" aria-labelledby="insere" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Alvará</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa/envia-arquivo.php" method="post" class="needs-validation-loading" enctype="multipart/form-data" novalidate autocomplete="off">
                <input id="empresasId" name="empresasId" value="<?=$empresaId?>" hidden>
                <input name="method" value="storeAlvara" hidden>
                <input name="arquivoRetorno" value="alvara.php" hidden>
                <div class="modal-body">
                    <div class="row mt-3 mb-3" id="div-upload">
                        <div class="col-md-12 label-cadastro">
                            <div>
                                <label for="guia">Upload do Arquivo *</label>
                                <input id="input-upload" class="form-control" type="file" name="fileUpload" required>
                                <div class="invalid-feedback">
                                    Escolha uma guia
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-around mt-3 mb-3">
                        <div class="col-5 text-center">
                            <label class="label-cadastro col-form-label mb-2 text-center">Data de Vencimento *</label>
                            <input name="dataVencimento" type="text" class="form-control input-vencimento text-center font-weight-bold" placeholder="00/00/0000" required>
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
