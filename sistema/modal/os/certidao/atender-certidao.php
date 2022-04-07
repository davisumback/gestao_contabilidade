<div class="modal fade" id="atender-certidao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Certidão</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" novalidate enctype="multipart/form-data" autocomplete="none">
                <input name="method" value="atendeOsCertidao" hidden>
                <input name="empresasId" value="<?=$os[0]['empresas_id']?>" hidden>
                <input name="usuariosId" value="<?=$_SESSION['id_usuario']?>" hidden>
                <input name="ordemDeServicoId" value="<?=$_REQUEST['os']?>" hidden>                         
                <div class="modal-body">
                    <?php foreach ($os as $valor) : ?>
                        <div class="row">
                            <div class="form-group col-6">
                                <label><?=str_replace('Emissão', 'Upload', $valor['descricao_emissao']) . ' ' . $valor['nomeItemOs']?></label>
                                <input name="certidoes[<?=$valor['item_id']?>]" value="" type="file" class="form-control" required>
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="label-cadastro">Data de Validade</label>
                                <input name="certidaoDataValidade[<?=$valor['item_id']?>]" type="text" class="form-control certidao-data-validade" placeholder="DD/MM/AAAA" required autocomplete="off">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="custom-control custom-checkbox">
                        <input id="enviaEmail" type="checkbox" class="custom-control-input" name="enviaEmail">
                        <label class="custom-control-label label-cadastro" for="enviaEmail">Enviar e-mail para o cliente</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-padrao btn-cor-primaria">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>