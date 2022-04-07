<div class="modal fade" id="enviaCartaPreCadastro" tabindex="-1" role="dialog" aria-labelledby="enviaCartaPreCadastro" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white font-weight-bold">Enviar Carta</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="needs-validation-loading" action="../controllers/grupob/prospect.php" method="post" novalidate autocomplete="none">
                    <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                    <input name="method" value="update" hidden>

                    <div class="row mt-4">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Escolher Arquivo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row mt-3 mb-4 div-botao-submit">
                        <div class="col text-center">
                            <button class="btn btn-padrao btn-success font-weight-bold" type="submit">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
