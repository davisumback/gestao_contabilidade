<div class="modal fade" id="modalEndereco" tabindex="-1" role="dialog" aria-labelledby="modalEndereco" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title">Alterar Endereço</h5>
            </div>

            <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" autocomplete="off" novalidate enctype="multipart/form-data">
                <input name="method" value="storeOsAlterarEndereco" hidden>
                <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                <input name="tipoOs" value="<?=$_GET['tipoOs']?>" hidden>
                <input name="osItemId" value="1" hidden>

                <div class="modal-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group text-center">
                                <label class="label-cadastro">Empresa</label>
                                <input class="form-control col-md-4 col-sm-6 mx-auto text-center" type="text" name="empresasId" required autocomplete="none" maxlength="4">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label><strong>Enviar comprovante do novo endereço</strong></label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input name="novoEndereco" type="file" class="custom-file-input" id="file" required onchange='$("#fileLabel").html($(this).val());'>
                                    <div class="invalid-feedback">
                                        Obrigatório*
                                    </div>
                                    <label class="custom-file-label procurar-arquivo" id="fileLabel" for="file">Selecionar arquivo</label>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-cor-primaria btn-padrao">Enviar</button>
                    <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>