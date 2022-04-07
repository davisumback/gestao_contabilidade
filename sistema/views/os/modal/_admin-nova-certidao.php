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

                <form class="needs-validation-loading" method="post" action="../controllers/os/admin-insere-os.php?method=store" novalidate autocomplete="none">
                    <input name="usuariosId" value="<?=$_SESSION['id_usuario']?>" hidden>
                    <input name="tipoOs" value="3" hidden>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group text-center">
                                <label class="label-cadastro">Empresa</label>
                                <input class="form-control col-md-3 col-sm-6 mx-auto text-center" type="text" name="empresasId" required="true" autocomplete="none" maxlength="4">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="federal" type="checkbox" autocomplete="off">Federal
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="estadual" type="checkbox" autocomplete="off">Estadual
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="municipal" type="checkbox" autocomplete="off">Municipal
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="trabalhista" type="checkbox" autocomplete="off">Trabalhista
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="simplificada" type="checkbox" autocomplete="off">Simplificada
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="falencia" type="checkbox" autocomplete="off">Falência
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="antecedentesCriminais" type="checkbox" autocomplete="off">Antecedentes Criminais
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="quitacaoEleitoral" type="checkbox" autocomplete="off">Quitação Eleitoral
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block">
                                    <input name="fgts" type="checkbox" autocomplete="off">FGTS
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-padrao">Enviar</button>
                    <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal">Fechar</button>
                </div>
            </form>
                
        </div>
    </div>
</div>