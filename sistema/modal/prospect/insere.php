<div class="modal fade" id="novo-prospect" tabindex="-1" role="dialog" aria-labelledby="novo-prospect" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title text-white">Cadastrar Novo Prospect</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <form class="needs-validation-loading" action="../controllers/ /insere-prospect.php" method="post" novalidate autocomplete="none"> -->
                <form class="needs-validation-loading" action="../controllers/grupob/prospect.php" method="post" novalidate autocomplete="none">
                    <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                    <input name="method" value="store" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-cadastro">Nome do Doutor</label>
                                <input class="form-control" type="text" name="nome_doutor" autocomplete="none">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-cadastro">Nome do Responsável</label>
                                <input class="form-control" type="text" name="nome_contato" autocomplete="none">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label-cadastro">Email *</label>
                                <input class="form-control" type="text" name="email" autocomplete="none" required>
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="label-cadastro">Telefone Comercial</label>
                                <input placeholder="(00) 0000-0000" class="form-control" type="text" id="telefone" name="telefone" autocomplete="none">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="label-cadastro">Celular</label>
                                <input placeholder="(00) 90000-0000" class="form-control" type="text" id="celular" name="celular" autocomplete="none">
                            </div>
                        </div>
                        <div class="col-md-4 label-cadastro">
                            <div class="custom-control custom-checkbox mt-3">
                                <input id="whats" name="WhatsApp" class="custom-control-input" type="checkbox" autocomplete="none">
                                <label class="custom-control-label" for="whats">WhatsApp</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-cadastro" for="">Sexo *</label>
                            <div class="input-group">
                                <select class="custom-select" name="sexo" required>
                                    <option value="" selected>Escolha...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-cadastro">Nome da Empresa</label>
                                <input class="form-control" type="text" name="nome_empresa" autocomplete="none">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label-cadastro">CNPJ</label>
                                <input placeholder="00.000.000/0000-00" class="form-control" type="text" id="cnpj" name="cnpj" autocomplete="none">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="label-cadastro">Estado *</label>
                            <select class="form-control" name="estado" id="estado" required="" autocomplete="none">
                                <option value="">Escolha...</option>
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
                                Obrigatório*
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label-cadastro">Cidade *</label>
                                <input class="form-control" type="text" name="cidade" required="" autocomplete="none">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="label-cadastro">Empresa que você está fazendo o Prospect *</label>
                            <select class="form-control" name="empresa_vinculo" required="" autocomplete="none">
                                <option value="">Escolha...</option>
                                <option value="MEDB">Medb</option>
                                <option value="MEDCONTABIL">Medcontabil</option>
                                <option value="LAWB">Lawb</option>
                            </select>
                            <div class="invalid-feedback">
                                Obrigatório*
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="label-cadastro">Profissão *</label>
                            <select class="form-control" name="profissao" id="inputProfissao" required="" autocomplete="none">
                                <option value="">Escolha...</option>
                                <option value="MEDICO">Médico(a)</option>
                                <option value="ENFERMEIRO">Enfermeiro(a)</option>
                                <option value="NUTRICIONISTA">Nutricionista</option>
                                <option value="ACADEMICO">Acadêmico(a)</option>
                                <option value="BIOMEDICO">Biomédico(a)</option>
                                <option value="BIOQUIMICO">Bioquímico(a)</option>
                                <option value="EDUCADORFISICO">Educador Físico</option>
                                <option value="FARMACIA">Farmácia</option>
                                <option value="ADVOGADO">Advogado</option>
                                <option value="DENTISTA">Dentista</option>
                                <option value="FISIOTERAPEUTA">Fisioterapeuta</option>
                                <option value="PSICOLOGO">Psicólogo</option>
                                <option value="ESTETICISTA">Esteticista</option>
                                <option value="FONOAUDIOLOGO">Fonoaudiólogo</option>
                                <option value="FORMANDO">Formando</option>
                            </select>
                            <div class="invalid-feedback">
                                Obrigatório*
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" id="linha-ano-formacao">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="label-cadastro">Instituição Ensino</label>
                                <input class="form-control" type="text" name="ies" id="input-ies" autocomplete="none">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="label-cadastro">Ano Formação</label>
                                <input class="form-control data-formacao" type="text" name="anoFormacao" id="input-ano-formacao" autocomplete="none">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-cadastro">Especialidade</label>
                                <input class="form-control" type="text" name="especialidade" autocomplete="none">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="label-cadastro">É clínica?</label>
                                <select class="form-control" name="clinica" autocomplete="none">
                                    <option value="">Escolha...</option>
                                    <option value="SIM">Sim</option>
                                    <option value="NAO">Não</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-4">
                        <div class="col text-center">
                            <button class="btn btn-padrao btn-success font-weight-bold" type="submit" name="button">Confirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
