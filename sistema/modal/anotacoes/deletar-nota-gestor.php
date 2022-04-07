<div class="modal fade" id="deleta-nota" tabindex="-1" role="dialog" aria-labelledby="deleta-nota" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Deletar Anotação</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text text-danger">Tem certeza que deseja deletar?</h5>
                <div class="text-right mt-2">
                    <form id="form-deleta-nota" class="needs-validation-loading d-inline-block" action="../controllers/nota/deleta-nota-gestor.php" method="post">
                        <input name="id" id="id-deleta-nota" hidden>
                        <input name="pasta" id="pasta" hidden>
                        <button type="submit" class="btn btn-danger btn-edita-usuario font-weight-bold">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>