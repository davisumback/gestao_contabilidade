<div class="modal fade" id="guia-datas-contador" tabindex="-1" role="dialog" aria-labelledby="guia-datas-contador" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Editar Datas da Guias</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/guia/altera-guia-datas-contador.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <div class="modal-body">
                    <h6 class="text-center label-cadastro">DAS</h6>
                    <div class="row justify-content-around">
                        <div class="col-5 text-center">
                            <label for="das-vencimento" class="label-cadastro col-form-label">Dia do vencimento</label>
                            <input name="das_vencimento" type="text" class="form-control text-center" id="das-vencimento" required>
                        </div>
                    </div>
                    <h6 class="text-center label-cadastro mt-3">PIS</h6>
                    <div class="row justify-content-around">
                        <div class="col-5 text-center">
                            <label for="pis-vencimento" class="label-cadastro col-form-label">Dia do vencimento</label>
                            <input name="pis_vencimento" type="text" class="form-control text-center" id="pis-vencimento" required>
                        </div>
                    </div>
                    <h6 class="text-center label-cadastro mt-3">COFINS</h6>
                    <div class="row justify-content-around">
                        <div class="col-5 text-center">
                            <label for="cofins-vencimento" class="label-cadastro col-form-label">Dia do vencimento</label>
                            <input name="cofins_vencimento" type="text" class="form-control text-center" id="cofins-vencimento" required>
                        </div>
                    </div>
                    <h6 class="text-center label-cadastro mt-3">IRPJ</h6>
                    <div class="row justify-content-around">
                        <div class="col-5 text-center">
                            <label for="irpj-vencimento" class="label-cadastro col-form-label">Dia do vencimento</label>
                            <input name="irpj_vencimento" type="text" class="form-control text-center" id="irpj-vencimento" required>
                        </div>
                    </div>
                    <h6 class="text-center label-cadastro mt-3">CSLL</h6>
                    <div class="row justify-content-around">
                        <div class="col-5 text-center">
                            <label for="csll-vencimento" class="label-cadastro col-form-label">Dia do vencimento</label>
                            <input name="csll_vencimento" type="text" class="form-control text-center" id="csll-vencimento" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
