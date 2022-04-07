<div class="modal fade" id="insereFaturamento" tabindex="-1" role="dialog" aria-labelledby="inserePis" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Faturamento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../controllers/empresa/insere-faturamento.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="empresasId" name="empresasId" hidden>
                <input name="method" value="store" hidden>
                <div class="modal-body">
                    <?php for ($i=1; $i<=12; $i++) : ?>
                        <?php $data = date('Y-m', strtotime("-$i month")); ?>
                        <div class="row mb-3">
                            <!-- <div class="col-6 mx-auto text-center">
                                <label for="" class="label-cadastro col-form-label">Mês</label>
                                <input class="text-center form-control" id="mes" type="text" name="mes" value="<?=\App\Helper\Helpers::formataDataCompetenciaView($data)?>" readonly>
                                <div class="invalid-feedback">
                                    Obrigatório *
                                </div>
                            </div> -->

                            <div class="col-7 mx-auto text-center">
                                <label for="" class="label-cadastro col-form-label">Valor *</label>
                                <input class="text-center form-control" id="mes" type="text" name="mes<?=$i?>" value="<?=\App\Helper\Helpers::formataDataCompetenciaView($data)?>" readonly>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input class="text-center form-control valor" id="valor" type="text" name="faturamento<?=$i?>" maxlength="25" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    <?php endfor ?>

                    <!-- <div class="row justify-content-end">
                        <div class="col-12 mb-3 label-cadastro">
                            <div class="text-center">
                                <button type="button" onclick="adicionaItemProposta()" class="btn btn-sm btn-padrao btn-cor-primaria font-weight-bold">Adicionar Faturamento</button>
                            </div>
                        </div>
                        <div class="col-12" id="divItemProposta"></div>
                    </div>

                    <div id="divPropostas"></div> -->

                </div>

                <div class="modal-footer">
                    <button class="btn btn-cor-primaria btn-padrao font-weight-bold" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>