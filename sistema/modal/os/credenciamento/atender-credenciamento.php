<div class="modal fade" id="atender-credenciamento" tabindex="-1" role="dialog" aria-labelledby="atender-credenciamento" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Credenciamento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" novalidate enctype="multipart/form-data" autocomplete="none">
                    <input name="method" value="atendeOsCredenciamento" hidden>
                    <input name="empresasId" value="<?=$credenciamento[0]['empresas_id']?>" hidden>
                    <input name="usuariosId" value="<?=$_SESSION['id_usuario']?>" hidden>
                    <input name="ordemDeServicoId" value="<?=$credenciamento[0]['ordens_de_servicos_id']?>" hidden>
                    <input name="pastaCredenciamento" value="<?=$credenciamento[0]['pasta']?>" hidden>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-1 label-cadastro">Selecione os arquivos:</div>
                            <input class="form-control" type="file" name="arquivos[]" multiple required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>                        
                    </div>

                    <div class="row">                       
                        <div class="col-sm-12 col-md-6">
                            <label class="label-cadastro" for="">Descrição</label>
                            <textarea name="descricao" rows="4" cols="50" class="form-control" type="text"></textarea>
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox mt-3">
                        <input checked id="enviaEmail" type="checkbox" class="custom-control-input" name="enviaEmail">
                        <label class="custom-control-label label-cadastro" for="enviaEmail">Enviar e-mail para o cliente</label>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-padrao btn-cor-primaria"><strong>Enviar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>