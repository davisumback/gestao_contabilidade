<div class="modal fade" id="atender-declaracaorendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Declaração de Rendimentos</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" novalidate enctype="multipart/form-data" autocomplete="none">
                <input name="method" value="atendeOsDeclaracaoRendimentos" hidden>
                <input name="empresasId" value="<?=$os[0]['empresas_id']?>" hidden>
                <input name="usuariosId" value="<?=$_SESSION['id_usuario']?>" hidden>
                <input name="ordemDeServicoId" value="<?=$_REQUEST['os']?>" hidden>
                
                <div class="modal-body">
                    <div class="row mb-5">
                        <div class="col-md-6 col-sm-12">
                            <label class="label-cadastro">Sócio: </label>
                            <h6><strong class="text-secondary"><?=$os[0]['nome_completo']?></strong></h6>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label class="label-cadastro">CPF: </label>
                            <h6><strong class="text-secondary"><?=\App\Helper\Helpers::mask($os[0]['cpf'],'###.###.###-##')?></strong></h6>
                        </div>                              
                    </div>

                    <?php foreach ($os as $valor) : ?>
                        <div class="row mb-1">
                            <div class="form-group col-12">
                                <label class="label-cadastro"><?=str_replace('Emissão de', 'Upload', $valor['descricao_emissao']) . ' ' . $valor['nomeItemOs']?></label>
                                <input name="declaracao" type="file" class="form-control mt-3" required>
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>                            
                        </div>
                    <?php endforeach ?>
                    <div class="custom-control custom-checkbox">
                        <input checked id="enviaEmail" type="checkbox" class="custom-control-input" name="enviaEmail">
                        <label class="custom-control-label label-cadastro" for="enviaEmail">Enviar e-mail para o cliente</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-padrao btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>