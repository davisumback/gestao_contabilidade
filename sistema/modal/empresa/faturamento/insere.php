<div class="modal fade" id="insereFaturamento" tabindex="-1" role="dialog" aria-labelledby="inserePis" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastrar Faturamento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/empresa/faturamento.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="empresasId" name="empresasId" hidden>
                <input name="method" value="storeFaturamentos" hidden>
                <div class="modal-body">
                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                        <?php $data = date('Y-m', strtotime("-$i month")); ?>
                        <div class="row mb-2">
                            <div class="col-7 mx-auto text-center">
                                <label for="" class="label-cadastro col-form-label">Data: <?=\App\Helper\Helpers::formataDataCompetenciaView($data)?></label>
                                <input hidden class="text-center form-control" id="mes" type="text" name="faturamentos[<?=$i?>][mes]" value="<?=\App\Helper\Helpers::formataDataCompetenciaView($data)?>" readonly>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input class="text-center form-control valor" id="valor<?=$i?>" type="text" name="faturamentos[<?=$i?>][faturamento]" value="0" maxlength="25" required>
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

                    <div class="row justify-content-around">
                        <div class="col-7 text-center">
                            <label class="label-cadastro">Valor Total</label>
                            <!-- <div class="label-cadastro" id="somaValores"></div> -->
                            <input class="form-control text-center" id="somaValores" readonly>
                            <!-- <label class="label-cadastro">Valor Total</label>
                            <input class="form-control" id="somaValores" readonly> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>