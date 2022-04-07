<div class="modal fade" id="deleta-email" tabindex="-1" role="dialog" aria-labelledby="deleta-email" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title text-white">Deletar Email</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa-email/deleta-email.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="deleta-id" name="id" hidden>

                <div class="modal-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-12 text-center">
                            <h5 class="text text-danger">Tem certeza que deseja deletar?</h5>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger btn-padrao font-weight-bold" type="submit">Apagar</button>
                </div>
            </form>
        </div>
    </div>
</div>
