<div class="modal fade" id="emitir-recibo" tabindex="-1" role="dialog" aria-labelledby="emitir-recibo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Emitir Recibo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="post" class="needs-validation-loading" novalidate autocomplete="off">
                <input id="clientesId" name="clientesId" hidden>
                <input name="method" value="storeEmail" hidden>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">CPF</label>
                            <input class="form-control" type="text" name="email" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Nome</label>
                            <input class="form-control" type="text" name="email" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">CEP</label>
                            <input class="form-control" type="text" name="email" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Endereço</label>
                            <input class="form-control" type="text" name="email" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Número</label>
                            <input class="form-control" type="text" name="email" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-7">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Cidade</label>
                            <input class="form-control" type="text" name="email" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="documento-uf" class="label-cadastro col-form-label">UF</label>
                            <select name="documento_uf" class="custom-select d-block w-100" id="documento-uf">
                                <option value="" id="escolha">Escolha...</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Competência</label>
                            <input class="form-control" type="text" name="email" placeholder="00/0000" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Valor</label>
                            <input class="form-control" type="text" name="email" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="" class="label-cadastro col-form-label">Descrição</label>
                            <textarea class="form-control" id="" type="text" rows="3">"Texto padrão pra emissão de recibo"</textarea>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="certificadoArquivo" class="label-cadastro col-form-label">Email</label>
                            <input class="form-control" type="text" name="email" maxlength="25" required>
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-success btn-padrao font-weight-bold">Enviar</button>
                            <button type="button" class="btn btn-info btn-padrao font-weight-bold">Imprimir</button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-padrao font-weight-bold" type="button" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>
