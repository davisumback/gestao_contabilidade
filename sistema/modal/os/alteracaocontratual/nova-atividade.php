<div class="modal fade" id="modalNovaAtividade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="exampleModalLabel">Nova Atividade</h5>
            </div>
            <form class="needs-validation" novalidate action="index.html" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for=""><strong>Descreva a nova atividade</strong></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            <div class="invalid-feedback">
                                Digite um nome válido
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-padrao" data-dismiss="modal">Enviar</button>
                    <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>
