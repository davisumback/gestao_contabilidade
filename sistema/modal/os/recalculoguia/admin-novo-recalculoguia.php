<?php
$tipoGuia = new \App\Model\Os\TipoGuia();
$tiposGuias = $tipoGuia->all();
?>
<div class="modal fade bd-example-modal-lg" id="osTipo4" tabindex="-1" role="dialog" aria-labelledby="osTipo4" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="osTipo4">Selecione guias a serem recalculadas</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" novalidate autocomplete="off">
                <input name="method" value="storeRecalculoGuia" hidden>
                <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                <input name="tipoOs" value="<?=$tipoOsId?>" hidden>

                <div class="modal-body">
                    <div class="row justify-content-end mb-4">
                        <div class="col-md-3">
                            <i class="fas fa-square icon-legenda-accent-secundaria"></i><span> Não Selecionada</span>
                        </div>
                        <div class="col-md-3">
                            <i class="fas fa-square icon-legenda-accent-primaria"></i> Selecionada
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group text-center">
                                <label class="label-cadastro">Empresa</label>
                                <input required class="form-control col-md-3 col-sm-6 mx-auto text-center" type="text" name="empresasId" maxlength="4">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php foreach ($tiposGuias as $tipo) : ?>
                            <div class="col-md-4 mb-3 text-center">
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                        <input name="guias[<?=$tipo['id']?>]" type="checkbox" autocomplete="off"><?=$tipo['nome']?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="label-cadastro"><strong>Nova data de vencimento</strong></label>
                            <input class="form-control" type="date" name="guias_vencimento" required>                            
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro"><strong>Data de Competência</strong></label>
                            <input class="form-control" type="month" name="guias_competencia" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-cor-primaria btn-padrao"><strong>Enviar</strong></button>
                    <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>