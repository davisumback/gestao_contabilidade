<div class="modal fade" id="modalNomeEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Nome da Empresa</h5>
            </div>
            <form class="needs-validation" novalidate action="index.html" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-11">
                            <label for=""><strong>Escreva os possivéis nomes para serem usados</strong></label>
                            <input class="form-control mt-2" type="text" placeholder="Primeiro nome" required>
                            <div class="invalid-feedback">
                                Digite um nome válido
                            </div>
                            <input class="form-control mt-3" type="text" placeholder="Segundo nome" required>
                            <div class="invalid-feedback">
                                Digite um nome válido
                            </div>
                            <input class="form-control mt-3" type="text" placeholder="Terceiro nome" required>
                            <div class="invalid-feedback">
                                Digite um nome válido
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cor-primaria btn-padrao" data-dismiss="modal">Enviar</button>
                    <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>
