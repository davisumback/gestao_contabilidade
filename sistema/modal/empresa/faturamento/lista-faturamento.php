<div class="modal fade" id="lista-faturamento" tabindex="-1" role="dialog" aria-labelledby="lista-faturamento" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Faturamentos</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-success">
                            <div class="card-header bg-success rounded-0 text-center">
                                <strong class="card-title text-white">Últimos Faturamentos</strong>
                            </div>
                            <div class="card-body">
                                <?php if (empty($faturamentos)) : ?>
                                    <h5 class="text-center text-success">Sem Faturamentos</h5>
                                <?php else : ?>
                                    <div class="table-responsive">                    
                                        <table class="table">
                                            <thead>
                                                <tr class='text-success text-center'>
                                                    <th scope="col">Mês</th>
                                                    <th scope="col">Faturamento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($faturamentos as $faturamento) : ?>
                                                    <tr class="text-center">
                                                        <td class="text-secondary font-weight-bold p-0"><?= $faturamento->getMes() ?></td>
                                                        <td class="text-secondary font-weight-bold p-0">R$ <?= $faturamento->getFaturamento() ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif ?>
                                <div class="row justify-content-around mt-3">
                                    <div class="col-md-6 text-center">
                                        <label class="label-cadastro font-weight-bold h5" for="">Email:</label>
                                        <input class="form-control" type="text" placeholder="Digite o email">
                                    </div>
                                </div>
                                <div class="row justify-content-around mt-3">
                                    <div class="col-md-6 text-center">
                                        <button type="button" class="btn btn-success btn-padrao" data-dismiss="modal"><strong>Enviar</strong></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
            </div>
        </div>
    </div>
</div>

