<div class="modal fade" id="deleta-desconto" tabindex="-1" role="dialog" aria-labelledby="deleta-desconto" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Deletar Desconto</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text text-danger">Tem certeza que deseja deletar?</h5>
                    <div class="text-right mt-2">
                        <form id="form-deleta-desconto" class="d-inline-block needs-validation-loading" action="../controllers/grupob/desconto.php" method="post">
                            <input name="id" id="id-deleta-desconto" hidden>
                            <input name="method" value="delete" hidden>

                            <button type="submit" class="btn btn-danger btn-padrao font-weight-bold">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>