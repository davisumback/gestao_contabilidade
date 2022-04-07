<div class="modal fade" id="osTipo1" tabindex="-1" role="dialog" aria-labelledby="osTipo1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="osTipo1">Nova Solicitação de Credenciamento</h5>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" autocomplete="off" novalidate enctype="multipart/form-data">
                <input name="method" value="storeOsCredenciamentoMedcontabil" hidden>
                <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                <input name="empresasId" value="<?=$empresasId?>" hidden>
                <input name="tipoOs" value="<?=$_GET['tipoOs']?>" hidden>

                <div class="modal-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group text-center">
                                <label hidden class="label-cadastro">Empresa</label>
                                <input hidden value="<?=$empresasId?>" required class="" type="text" name="empresasId" autocomplete="off" maxlength="4">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label class="label-cadastro">Enviar Edital</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input onchange='$("#fileLabel").html($(this).val());' type="file" class="custom-file-input" name="edital" required>
                                    <label id="fileLabel" class="custom-file-label procurar-arquivo" for="edital">Escolha um arquivo</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3 label-cadastro">
                            <label for="proposta">O Edital possui proposta?</label>
                            <select name="possuiProposta" class="custom-select d-block" id="proposta" required>
                                <option value="">Escolha...</option>
                                <option value="S">Sim</option>
                                <option value="N">Não</option>
                            </select>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>

                    <div id="divPropostas">
                        
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-4">
                            <label for=""><b>Valor da Hora</b></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="money">
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-cor-primaria btn-padrao"><strong>Enviar</strong></button>
                    <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>