<div class="modal fade" id="deleta-cnae" tabindex="-1" role="dialog" aria-labelledby="deleta" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title text-white">Deletar CNAE</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa/cnae.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input name="id" id="idDeletaCnae" value="" hidden>
                <input name="method" value="delete" hidden>
                <input name="arquivoRetorno" value="<?=$arquivoRetorno?>" hidden>

                <div class="modal-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-12 text-center">
                            <h5 class="text text-danger">Tem certeza que deseja deletar esse CNAE?</h5>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger btn-padrao" type="submit">Deletar</button>
                </div>
            </form>
        </div>
    </div>
</div>
