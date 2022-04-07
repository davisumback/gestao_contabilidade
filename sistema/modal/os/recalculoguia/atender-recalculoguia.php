<div class="modal fade" id="atender-recalculoguia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Recálculo Guia</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" novalidate enctype="multipart/form-data" autocomplete="none">
                <input name="method" value="atendeOSRecalculoGuia" hidden>
                <input name="empresasId" value="<?=$os[0]['empresas_id']?>" hidden>
                <input name="usuariosId" value="<?=$_SESSION['id_usuario']?>" hidden>
                <input name="ordemDeServicoId" value="<?=$_REQUEST['os']?>" hidden>
                
                <div class="modal-body">
                    <div class="row mb-5">
                        <div class="col-6">
                            <label class="label-cadastro">Data vencimento solicitada:</label>
                            <h6 class="text-secondary"><strong><?=App\Helper\Helpers::formataDataView($os[0]['data_vencimento'])?></strong></h6>
                        </div>

                        <div class="col-6">
                            <label class="label-cadastro">Competência solicitada:</label>
                            <h6 class="text-secondary"><strong><?=App\Helper\Helpers::formataDataCompetenciaView($os[0]['data_competencia'])?></strong></h6>
                        </div>
                    </div>

                    <?php foreach ($os as $valor) : ?>
                        <div class="row">
                            <div class="form-group col-12">
                                <?php
                                    if ($valor['nomeItemOs'] == 'HONORÁRIOS') {
                                        $valor['descricao_emissao'] = str_replace('Recálculo dos', 'Upload', $valor['descricao_emissao']);
                                    }
                                    $valor['descricao_emissao'] = str_replace('Recálculo do', 'Upload', $valor['descricao_emissao']);
                                ?>

                                <label class="label-cadastro"><?=$valor['descricao_emissao'] . ' ' . $valor['nomeItemOs']?></label>
                                <input name="guias[<?=$valor['item_id']?>]" type="file" class="form-control" required>
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                            
                            <div class="form-group col-6">
                                <label class="label-cadastro">Data de Vencimento</label>
                                <input name="guiasDatas[<?=$valor['item_id']?>][vencimento]" type="text" class="form-control dataFormat" placeholder="DD/MM/AAAA" required autocomplete="off">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label class="label-cadastro">Competência</label>
                                <input name="guiasDatas[<?=$valor['item_id']?>][competencia]" type="text" class="form-control competenciaFormat" placeholder="MM/AAAA" required autocomplete="off">
                                <input name="guiasDatas[<?=$valor['item_id']?>][guiaTipo]" value="<?=$valor['nomeItemOs']?>" hidden>
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
                    <button type="submit" class="btn btn-padrao btn-cor-primaria">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>