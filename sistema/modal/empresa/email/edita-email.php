<div class="modal fade" id="edita-email" tabindex="-1" role="dialog" aria-labelledby="edita-email" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <h5 class="modal-title">Editar Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa-email/edita-email.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="edita-id" name="id" value="" hidden>
                <input name="empresasId" value="<?=$empresaId?>" hidden>
                <div class="modal-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <label for="email" class="label-cadastro col-form-label text-dark">Email</label>
                            <input name="email" type="text" class="form-control text-dark" id="edita-email" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning btn-padrao font-weight-bold" type="submit">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
