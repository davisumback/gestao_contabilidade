<div class="modal fade" id="insereCertificado" tabindex="-1" role="dialog" aria-labelledby="insereCertificado" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Novo Certificado</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/nfse/certificado.php?method=store" method="post" class="needs-validation-loading" novalidate autocomplete="off" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4 mx-auto text-center">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Empresa*</label>
                            <input class="text-center form-control" type="text" name="empresasId" maxlength="4" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Certificado* (Arquivo .pfx)</label>
                            <input class="form-control" type="file" name="fileUpload" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                     <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <label for="senha" class="label-cadastro col-form-label">Senha*</label>
                            <input class="form-control" type="texto" name="senha" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <label for="dataValidade" class="label-cadastro col-form-label">Data de Vencimento da Validade*</label>
                            <input placeholder="DD/MM/AAAA" id="dataValidade" class="form-control" type="texto" name="dataValidade" required>
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
