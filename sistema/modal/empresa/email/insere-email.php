<div class="modal fade" id="novo-email" tabindex="-1" role="dialog" aria-labelledby="novo-email" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Novo Email</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa-email/insere-email.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input name="empresasId" value="<?=$empresaId?>" hidden>
                <div class="modal-body">
                    <div class="row my-1">
                        <div class="col-12">
                            <label for="email" class="label-cadastro col-form-label">Email</label>
                            <input name="email" type="text" class="form-control" id="email" required>
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
