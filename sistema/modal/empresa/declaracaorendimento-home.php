<div class="modal fade" id="rendimento-home" tabindex="-1" role="dialog" aria-labelledby="rendimento-home" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Declaração de Rendimento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive" id="tableSocios">
                            <table id="myTable" class="mt-3 table">
                                <thead class="label-cadastro">
                                    <tr class="table-success text-center" role="row">
                                        <th scope="col">Nome</th>                                            
                                        <th scope="col">Sócio Administrador</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-success font-weight-bold">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">                                       
                                        <tr onclick="">
                                            <td class="text-center">Tiago Martines</td>
                                            <td class="text-center">Sim</td>
                                            <td class="text-center">
                                                <div class="custom-control custom-radio text-center">
                                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr onclick="">
                                            <td class="text-center">Lorem Ipsum</td>
                                            <td class="text-center">Não</td>
                                            <td class="text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col text-center">
                        <h5 class="label-cadastro font-weight-bold">
                            Renda média: 
                            <span class="text-dark">R$ 1000,00</span>
                        </h5>
                    </div>
                </div>
                <div class="row justify-content-around mt-4">
                    <div class="col-md-6 text-center">
                        <label class="label-cadastro font-weight-bold h5" for="">Alterar renda (opcional)</label>
                        <input class="form-control" type="text" placeholder="Digite o valor da nova renda">
                    </div>
                </div>
                <div class="row justify-content-around mt-5">
                    <div class="col-md-6 text-center">
                        <label class="label-cadastro font-weight-bold h5" for="">Email</label>
                        <input class="form-control" type="text" placeholder="Digite o email">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-padrao" data-dismiss="modal"><strong>Enviar</strong></button>
                <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
            </div>
        </div>
    </div>
</div>

