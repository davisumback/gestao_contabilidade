<div class="modal fade" id="deletaProspect" tabindex="-1" role="dialog" aria-labelledby="editaProspect" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white font-weight-bold">Deletar Prospect</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="needs-validation-loading" action="../controllers/grupob/prospect.php" method="post" novalidate autocomplete="none">
                    <input name="prospectId" id="prospectId" hidden>
                    <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                    <input name="nome_doutor" id="prospectNome" hidden>
                    <input name="email" id="prospectEmail" hidden>
                    <input name="nome_contato" id="prospectContato" hidden>
                    <input name="celular" id="prospectCelular" hidden>
                    <input name="telefone" id="prospectTelefone" hidden>
                    <input name="nome_empresa" id="prospectNomeEmpresa" hidden>
                    <input name="cnpj" id="prospectCnpj" hidden>
                    <input name="profissao" id="prospectProfissao" hidden>
                    <input name="especialidade" id="prospectEspecialidade" hidden>
                    <input name="method" value="delete" hidden>

                    <div class="row mt-3">
                        <div class="col-7 col-md-12 text-center">
                            <h5>Tem certeza que deseja excluir esse prospect?</h5>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-7 col-md-12 text-right">
                            <button type="submit" class="btn btn-padrao btn-danger font-weight-bold">Deletar</button>
                            <button type="button" class="btn btn-padrao btn-secondary font-weight-bold" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
