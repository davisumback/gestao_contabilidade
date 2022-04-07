<div class="modal fade" id="deleta" tabindex="-1" role="dialog" aria-labelledby="deleta" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title text-white">Deletar Funcionário</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa/funcionario.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id='deleta-funcionario' name="funcioarioId" hidden>
                <input name="method" value="delete" hidden>
                <div class="modal-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-12 text-center">
                            <h5 class="text text-danger">Tem certeza que deseja deletar essa funcionário?</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-padrao font-weight-bold" type="submit">Deletar</button>
                </div>
            </form>
        </div>
    </div>
</div>
