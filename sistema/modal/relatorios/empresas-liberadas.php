<div class="modal fade" id="empresasLiberadas" tabindex="-1" role="dialog" aria-labelledby="empresasLiberadas" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">Pesquisa de empresas liberadas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-pesquisa" class="pesquisa-empresas-liberadas" novalidate autocomplete="off">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-5 mx-auto text-center">
                            <label for="certificadoArquivo" class="label-cadastro text-info col-form-label">Data *</label>
                            <input id="data-pesquisa" class="text-center form-control" type="text" name="data" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm btn-info btn-padrao" type="submit">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>
</div>
