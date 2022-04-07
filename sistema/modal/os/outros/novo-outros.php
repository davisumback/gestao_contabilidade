<div class="modal fade bd-example-modal-lg" id="osTipo6" tabindex="-1" role="dialog" aria-labelledby="osTipo6" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title">Solicitar Outros Serviços</h5>
            </div>

            <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" autocomplete="off" novalidate>
                <input name="method" value="storeOsOutros" hidden>
                <input name="tipoOs" value="6" hidden>
                <input name="osItemId" value="1" hidden>                
                <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                <input name="empresasId" value="<?=$empresasId?>" hidden>
                <input name="tipoOs" value="<?=$_GET['tipoOs']?>" hidden>

                <div class="modal-body">                  
                    <div class="row">
                        <div class="col">
                            <label class="label-cadastro"><strong>Digite seu texto</strong></label>
                            <textarea name="texto" class="form-control" rows="4" cols="50" required></textarea>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-cor-primaria btn-padrao"><b>Ok</b></button>
                    <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>