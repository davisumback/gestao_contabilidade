<div class="modal fade" id="editaProspect" tabindex="-1" role="dialog" aria-labelledby="editaProspect" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark font-weight-bold">Editar Prospect</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="needs-validation-loading" action="../controllers/grupob/prospect.php" method="post" novalidate autocomplete="none">
                    <input name="prospectId" id="prospectId" hidden>
                    <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                    <input name="method" value="update" hidden>

                    <div class="row mt-4">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Nome do Doutor</label>
                                <input id="prospectNome" class="form-control" type="text" name="nome_doutor" autocomplete="none" required>
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Nome do Contato</label>
                                <input id="prospectContato" class="form-control" type="text" name="nome_contato" autocomplete="none">
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Email</label>
                                <input id="prospectEmail" class="form-control" type="text" name="email" autocomplete="none" required>
                                <div class="invalid-feedback">
                                    Obrigatório*
                                </div>
                            </div>
                        </div>                 
                    </div>

                    <div class="row mt-4">
                        <div class="col-7 col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Telefone</label>
                                <input id="prospectTelefone" placeholder="(00) 0000-0000" class="form-control" type="text" name="telefone" autocomplete="none">
                            </div>
                        </div>
                        <div class="col-7 col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Celular</label>
                                <input id="prospectCelular" placeholder="(00) 90000-0000" class="form-control" type="text" name="celular" autocomplete="none">
                            </div>
                        </div>                        
                    </div>

                    <div class="row mt-4">
                        <div class="col-7 col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Nome da Empresa</label>
                                <input id="prospectNomeEmpresa" class="form-control" type="text" name="nome_empresa" autocomplete="none">
                            </div>
                        </div>
                        <div class="col-7 col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">CNPJ</label>
                                <input id="prospectCnpj" placeholder="00.000.000/0000-00" class="form-control" type="text" name="cnpj" autocomplete="none">
                            </div>
                        </div>                        
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6 col-sm-12">
                            <label class="font-weight-bold">Profissão *</label>
                            <select class="form-control" name="profissao" id="propectProfissao" required="" autocomplete="none">
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
                                <!-- <option value="FRANQUEADOS">Franqueados</option> -->
                            </select>
                            <div class="invalid-feedback">
                                Obrigatório*
                            </div>
                        </div>
                        <div class="col-7 col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Especialidade</label>
                                <input class="form-control" type="text" id="propectEspecialidade" name="especialidade" autocomplete="none">
                            </div>
                        </div>                        
                    </div>

                    <div class="row mt-3 mb-4 div-botao-submit">
                        <div class="col text-center">
                            <button class="btn btn-padrao btn-warning font-weight-bold" type="submit">Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
