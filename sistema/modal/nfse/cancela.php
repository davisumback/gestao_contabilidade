<div class="modal fade bd-example-modal-lg" id="cancelaNota" tabindex="-1" role="dialog" aria-labelledby="emite" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Cancelar Nota Fiscal</h5>
            </div>
            <form class="needs-validation-loading" action="../controllers/nfse/nota-fiscal.php" method="post" autocomplete="off" novalidate>
                <input name="empresasId" value="<?=$empresasId?>" hidden>
                <input name="method" value="cancelaNota" hidden>
                <input name="caminhoRetorno" value="nota-fiscal.php?empresasId=<?=$empresasId?>" hidden>
                <input name="notaFiscalId" id="notaFiscalId" hidden>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class='text-danger'>Você tem certeza que deseja cancelar essa nota?</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-padrao btn-danger">Confirmar</button>
                    <button type="button" class="btn btn-padrao btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>          
        </div>
    </div>
</div>
