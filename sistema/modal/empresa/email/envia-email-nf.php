<div class="modal fade" id="envia-email-nf" tabindex="-1" role="dialog" aria-labelledby="envia-email-nf" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Enviar Email Nota Fiscal</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa-email/insere-email.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input name="empresasId" value="<?=$empresaId?>" hidden>

                <div class="modal-body">
                    <div class="row my-2">
                        <div class="col-12">
                            <label for="email" class="label-cadastro col-form-label">Para: </label>
                            <input name="email" type="text" class="form-control" id="email" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <label for="email" class="label-cadastro col-form-label">Titulo</label>
                            <input name="email" type="text" class="form-control" id="email" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-12">
                            <label for="email" class="label-cadastro col-form-label">Assunto:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" required></textarea>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" required>
                                <label class="custom-file-label" for="customFile">Escolher Arquivo</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success btn-success btn-padrao font-weight-bold" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
