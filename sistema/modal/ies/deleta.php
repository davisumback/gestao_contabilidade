<div class="modal fade" id="deleta-ies" tabindex="-1" role="dialog" aria-labelledby="deleta-ies" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Deletar IES</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text text-danger">Tem certeza que deseja deletar?</h5>
                    <div class="text-right mt-2">
                        <form id="form-deleta-ies" class="d-inline-block" action="../controllers/ies/ies.php" method="post">
                            <input name="id" id="id-deleta-ies" hidden>
                            <input name="method" value="delete" hidden>

                            <button type="submit" class="btn btn-padrao btn-danger font-weight-bold">Deletar</button>
                            <button type="button" class="btn btn-padrao btn-secondary font-weight-bold" data-dismiss="modal">Fechar</button>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>