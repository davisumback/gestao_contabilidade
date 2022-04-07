<div class="modal fade bd-example-modal-lg" id="empresa" role="dialog" aria-labelledby="empresa" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="exampleModalLabel">Escolha a Empresa</h5>
            </div>
            <form class="needs-validation-loading" action="../controllers/empresa/empresa.php" method="post" autocomplete="off" novalidate>
                <input name="method" value="isEmpresaNfse" hidden>
                <input name="arquivoRetorno" value="nota-fiscal.php" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mx-auto text-center">
                            <label class="label-cadastro">Empresa</label>
                            <div class="input-group mb-3">
                                <input id="empresasId" name="empresasId" type="text" class="text-center form-control" required maxlength="4">
                                <div class="invalid-feedback">
                                    Campo Obrigatório.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-padrao btn-cor-primaria">Enviar</button>
                    <button type="button" onClick="vaiParaNovaPagina('index.php')" class="btn btn-padrao btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>