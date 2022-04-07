<div class="modal fade" id="edita-conta-bancaria" tabindex="-1" role="dialog" aria-labelledby="edita-email" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <h5 class="modal-title text-dark">Editar Conta Bancaria</h5>
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
                            <label for=""><strong>Escolha a Conta a ser editada</strong></label>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-warning btn-padrao" type="submit"><strong>Editar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>
