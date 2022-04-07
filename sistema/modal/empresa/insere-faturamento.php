<div class="modal fade" id="insereFaturamento" tabindex="-1" role="dialog" aria-labelledby="inserePis" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Faturamento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa/insere-faturamento.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="empresasId" name="empresasId" hidden>
                <input name="method" value="store" hidden>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-6 mx-auto text-center">
                            <label for="" class="label-cadastro col-form-label">Valor *</label>
                            <input class="text-center form-control" type="text" name="faturamento" placeholder="R$" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>

                        <div class="col-6 mx-auto text-center">
                            <label for="" class="label-cadastro col-form-label">Mês *</label>
                            <input class="text-center form-control" type="text" name="faturamento" placeholder="00/0000" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>                   
                </div>

                <div class="modal-footer">
                    <button class="btn btn-cor-primaria btn-padrao font-weight-bold" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
