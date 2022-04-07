<div class="modal fade" id="inativa" tabindex="-1" role="dialog" aria-labelledby="inativa" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title text-white">Inativar Empresa</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa/ativacao.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input name="empresasId" value="<?= $_SESSION['viewIdEmpresa'] ?>" hidden>
                <input value="desativaEmpresa" name="method" hidden>

                <div class="modal-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-12 text-center">
                            <h5 class="text text-danger">Tem certeza que deseja desativar essa empresa?</h5>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger btn-padrao" type="submit">Desativar</button>
                </div>
            </form>
        </div>
    </div>
</div>
