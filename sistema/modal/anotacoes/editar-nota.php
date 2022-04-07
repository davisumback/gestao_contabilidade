<div class="modal fade" id="altera-nota" tabindex="-1" role="dialog" aria-labelledby="altera-nota" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title">Editar Anotação</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/nota/altera-nota.php" method="POST" class="needs-validation-loading" novalidate autocomplete="off">
                    <input name="pasta" value="<?=$_SESSION['pasta']?>" hidden>
                    <input name="id_usuario" value="<?=$_SESSION['id_usuario']?>" hidden>
                    <input name="id" id="altera-id" hidden>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="titulo" class="label-cadastro">Título da Nota</label>
                            <input name="titulo" type="text" class="label-cadastro form-control" id="altera-titulo" required>
                            <div class="invalid-feedback">
                                Digite um título válido para a nota.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="texto-nota" class="label-cadastro">Conteúdo</label>
                            <textarea name="texto" class="form-control" id="altera-texto" rows="6" required></textarea>
                            <div class="invalid-feedback">
                                Digite uma descrição para a nota válida.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="texto-nota" class="label-cadastro">Data de retorno</label>
                            <input name="data_retorno" type="date" class="label-cadastro form-control" id="altera-retorno">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-padrao font-weight-bold" type="submit">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>