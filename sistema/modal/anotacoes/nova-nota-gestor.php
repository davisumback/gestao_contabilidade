<div class="modal fade" id="nova-nota" tabindex="-1" role="dialog" aria-labelledby="nova-nota" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title text-white">Nova Nota</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/nota/insere-nota-gestor.php" method="POST" class="needs-validation-loading" novalidate autocomplete="off">
                    <input name="pasta" value="<?=$_SESSION['pasta']?>" hidden>
                    <input name="id_usuario" value="<?=$_SESSION['id_usuario']?>" hidden>
                    <input name="id_empresa" value="<?=$_SESSION['viewIdEmpresa']?>" hidden>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="titulo" class="label-cadastro">Título da Nota</label>
                            <input name="titulo" type="text" class="label-cadastro form-control" id="titulo" required>
                            <div class="invalid-feedback">
                                Digite um título válido para a nota.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="texto-nota" class="label-cadastro">Conteúdo</label>
                            <textarea name="texto" class="form-control" id="texto-nota" rows="6" required></textarea>
                            <div class="invalid-feedback">
                                Digite uma descrição para a nota válida.
                            </div>
                        </div>
                    </div>
                    <div class="row" hidden>
                        <div class="col-md-12 mb-3">
                            <label for="texto-nota" class="label-cadastro">Data de retorno</label>
                            <input name="data_retorno" type="date" class="label-cadastro form-control" id="titulo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-padrao btn-success btn-sm font-weight-bold" type="submit">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>