<div class="modal fade bd-example-modal-lg" id="modalSocio" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title">Alterar Sócio</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Quotas</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Davi André Sumback <span class="badge badge-info">adm</span></td>
                                <td>88888888888</td>
                                <td>40%</td>
                                <td>
                                    <button type="button" class="btn mb-2 btn-info btn-sm btn-padrao" data-toggle="modal" data-dismiss="modal" data-target="#modalEditarSocio">Editar</button>
                                    <button type="button" class="btn mb-2 btn-warning btn-sm btn-padrao">Remover</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jacob</td>
                                <td>88888888888</td>
                                <td>30%</td>
                                <td>
                                    <button type="button" class="btn mb-2 btn-info btn-sm btn-padrao" data-toggle="modal" data-dismiss="modal" data-target="#modalEditarSocio">Editar</button>
                                    <button type="button" class="btn mb-2 btn-warning btn-sm btn-padrao">Remover</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Larry</td>
                                <td>88888888888</td>
                                <td>30%</td>
                                <td>
                                    <button type="button" class="btn mb-2 btn-info btn-sm btn-padrao" data-toggle="modal" data-dismiss="modal" data-target="#modalEditarSocio">Editar</button>
                                    <button type="button" class="btn mb-2 btn-warning btn-sm btn-padrao">Remover</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-3 mb-4">
                    <div class="col text-center">
                        <button type="button" class="btn btn-padrao btn-success" data-toggle="modal" data-dismiss="modal" data-target="#modalNovoSocio" aria-expanded="false" aria-controls="collapseExample"><strong>Novo Sócio</strong></button>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>