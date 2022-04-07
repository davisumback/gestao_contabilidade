<?php
$tipoCertidao = new \App\Model\Os\TipoCertidao();
$tiposCertidoes = $tipoCertidao->all();
?>

<div class="modal fade bd-example-modal-lg" id="osTipo3" tabindex="-1" role="dialog" aria-labelledby="osTipo3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title">Selecione quais certidões você deseja solicitar</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-end mb-4">
                    <div class="col-md-3">
                        <i class="fas fa-square icon-legenda-accent-secundaria"></i> Não Selecionada
                    </div>
                    <div class="col-md-3">
                        <i class="fas fa-square icon-legenda-accent-primaria"></i> Selecionada
                    </div>
                </div>
                <form class="needs-validation-loading" method="post" action="../controllers/ordem-servico/admin.php?method=storeOsCertidao" novalidate autocomplete="none">
                    <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                    <input name="tipoOs" value="3" hidden>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group text-center">
                                <label class="label-cadastro">Empresa</label>
                                <input required class="form-control col-md-3 col-sm-6 mx-auto text-center" type="text" name="empresasId" autocomplete="none" maxlength="4">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($tiposCertidoes as $tipo) : ?>
                            <div class="col-md-4 mb-3 text-center">
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                        <input name="certidoes[<?=$tipo['id']?>]" type="checkbox" autocomplete="off"><?=$tipo['nome']?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach ?>                       
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="alert alert-danger" role="alert">
                                <strong>ATENÇÃO!</strong> As certidões <strong>Simplificadas, Falência e Antecedentes Criminais</strong> podem ter taxas extras<strong>!</strong>
                            </div>
                        </div>
                    </div>                 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-padrao btn-cor-primaria font-weight-bold">Enviar</button>
                    <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
                </div>
            </form>                
        </div>
    </div>
</div>