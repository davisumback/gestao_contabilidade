<div class="modal fade" id="cadastro-empresa-abertura" tabindex="-1" role="dialog" aria-labelledby="cadastro-empresa-abertura" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title text-white">Cadastro de Abertura</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <div class="row">
                    <div class="col-6 mb-3 label-cadastro text-center">
                        <h5>Tipo Societário</h5>
                    </div>
                    <div class="col-6 mb-3 label-cadastro text-center">
                        <h5>Tipo do Estabelecimento</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3 label-cadastro text-center">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1">LTDA</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">EIRELI</label>
                        </div>
                    </div>
                    <div class="col-6 mb-3 label-cadastro text-center">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" name="customRadioInline2" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline3">Físico</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline4" name="customRadioInline2" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline4">Ponto de referência</label>
                        </div>
                    </div>
                </div>
                
                <div id="div-form-cadastro">
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">Nome</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">CPF</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">RG</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>                
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">Email</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">Telefone</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro h6" for="estado">Sexo</label>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-info btn-padrao font-weight-bold">
                                    <input type="radio" name="options" id="option1" autocomplete="off"> Masculino
                                </label>
                                <label class="btn btn-info btn-padrao font-weight-bold">
                                    <input type="radio" name="options" id="option2" autocomplete="off"> Feminino
                                </label>
                            </div>
                        </div>
                    </div>                               
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">Estado Civil</label>
                            <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                <option value="" id="escolha">Escolha...</option>
                                <option value="AC" id="AC">Casado(a)</option>
                                <option value="AL" id="AL">Solteiro(a)</option>
                                <option value="AP" id="AP">Divorciado(a)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro h6" for="estado">Profissão</label>
                            <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                <option value="" id="escolha">Escolha...</option>
                                <option value="AC" id="AC">Médicos</option>
                                <option value="AL" id="AL">Outros</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">Nacionalidade</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row mt-3">                    
                        <div class="col-md-2">
                            <label class="label-cadastro font-weight-bold h6" for="">Porcentagem</label>
                            <input class="form-control text-center col-6" type="text" placeholder="%">
                        </div>
                    </div>
                </div>
                    
                <hr>

                <div class="row mt-3">                        
                    <div class="col-md-3">
                        <label class="label-cadastro font-weight-bold h6" for="">IPTU</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4">
                        <label class="label-cadastro font-weight-bold h6" for="">Inscrição Imobiliaria/Fiscal</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-3">
                        <label class="label-cadastro font-weight-bold h6" for="">Metragens</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label class="label-cadastro font-weight-bold h6" for="">CEP</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5">
                        <label class="label-cadastro font-weight-bold h6" for="">Endereço</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="label-cadastro font-weight-bold h6" for="">Nº</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" class="custom-control-input" id="check-endereco-empresa">
                            <label class="custom-control-label label-cadastro" for="check-endereco-empresa">Endereço da empresa</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-7">
                        <label class="label-cadastro font-weight-bold h6" for="">Complemento</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5">
                        <label class="label-cadastro font-weight-bold h6" for="">Bairro</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="label-cadastro font-weight-bold h6" for="">Cidade</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-3">
                        <label class="label-cadastro h6" for="estado">Estado</label>
                        <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                            <option value="" id="escolha">Escolha...</option>
                            <option value="AC" id="AC">Acre</option>
                            <option value="AL" id="AL">Alagoas</option>
                            <option value="AP" id="AP">Amapá</option>
                            <option value="AM" id="AM">Amazonas</option>
                            <option value="BA" id="BA">Bahia</option>
                            <option value="CE" id="CE">Ceará</option>
                            <option value="DF" id="DF">Distrito Federal</option>
                            <option value="ES" id="ES">Espírito Santo</option>
                            <option value="GO" id="GO">Goiás</option>
                            <option value="MA" id="MA">Maranhão</option>
                            <option value="MT" id="MT">Mato Grosso</option>
                            <option value="MS" id="MS">Mato Grosso do Sul</option>
                            <option value="MG" id="MG">Minas Gerais</option>
                            <option value="PA" id="PA">Pará</option>
                            <option value="PB" id="PB">Paraíba</option>
                            <option value="PR" id="PR">Paraná</option>
                            <option value="PE" id="PE">Pernambuco</option>
                            <option value="PI" id="PI">Piauí</option>
                            <option value="RJ" id="RJ">Rio de Janeiro</option>
                            <option value="RN" id="RN">Rio Grande do Norte</option>
                            <option value="RS" id="RS">Rio Grande do Sul</option>
                            <option value="RO" id="RO">Rondônia</option>
                            <option value="RR" id="RR">Roraima</option>
                            <option value="SC" id="SC">Santa Catarina</option>
                            <option value="SP" id="SP">São Paulo</option>
                            <option value="SE" id="SE">Sergipe</option>
                            <option value="TO" id="TO">Tocantins</option>
                        </select>
                    </div>
                </div>

                <div id="endereco-socio-adm" hidden>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <h5 class="label-cadastro">Endereço Sócio Administrador</h5>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <label class="label-cadastro font-weight-bold h6" for="">CEP</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-3">
                            <label class="label-cadastro font-weight-bold h6" for="">IPTU</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">Inscrição Imobiliaria/Fiscal</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <label class="label-cadastro font-weight-bold h6" for="">Endereço</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="label-cadastro font-weight-bold h6" for="">Nº</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mt-4">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label label-cadastro" for="customCheck1">Endereço da empresa</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <label class="label-cadastro font-weight-bold h6" for="">Bairro</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="label-cadastro font-weight-bold h6" for="">Cidade</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="col-md-3">
                            <label class="label-cadastro h6" for="estado">Estado</label>
                            <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                <option value="" id="escolha">Escolha...</option>
                                <option value="AC" id="AC">Acre</option>
                                <option value="AL" id="AL">Alagoas</option>
                                <option value="AP" id="AP">Amapá</option>
                                <option value="AM" id="AM">Amazonas</option>
                                <option value="BA" id="BA">Bahia</option>
                                <option value="CE" id="CE">Ceará</option>
                                <option value="DF" id="DF">Distrito Federal</option>
                                <option value="ES" id="ES">Espírito Santo</option>
                                <option value="GO" id="GO">Goiás</option>
                                <option value="MA" id="MA">Maranhão</option>
                                <option value="MT" id="MT">Mato Grosso</option>
                                <option value="MS" id="MS">Mato Grosso do Sul</option>
                                <option value="MG" id="MG">Minas Gerais</option>
                                <option value="PA" id="PA">Pará</option>
                                <option value="PB" id="PB">Paraíba</option>
                                <option value="PR" id="PR">Paraná</option>
                                <option value="PE" id="PE">Pernambuco</option>
                                <option value="PI" id="PI">Piauí</option>
                                <option value="RJ" id="RJ">Rio de Janeiro</option>
                                <option value="RN" id="RN">Rio Grande do Norte</option>
                                <option value="RS" id="RS">Rio Grande do Sul</option>
                                <option value="RO" id="RO">Rondônia</option>
                                <option value="RR" id="RR">Roraima</option>
                                <option value="SC" id="SC">Santa Catarina</option>
                                <option value="SP" id="SP">São Paulo</option>
                                <option value="SE" id="SE">Sergipe</option>
                                <option value="TO" id="TO">Tocantins</option>
                            </select>
                        </div>
                    </div>
                </div>                                          

                <hr>

                <div class="row mt-3 mb-4">
                    <div class="col text-center">
                        <h5 class="label-cadastro">Sócios</h5>
                    </div>
                </div>

                <div class="" id="incluir-socio">

                </div>

                <!-- <div class="row">
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-secondary btn-padrao font-weight-bold" onclick="adicionaSocio()">Adicionar Sócio</button>
                    </div>
                </div> -->

                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-secondary btn-padrao font-weight-bold" id="button-teste"x>Adicionar Sócio</button>
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

