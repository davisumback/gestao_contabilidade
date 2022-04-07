<div class="modal fade" id="alteraContato" tabindex="-1" role="dialog" aria-labelledby="alteraContato" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-dark font-weight-bold">Editar Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-altera-contato" action="../controllers/contato/contato.php" method="post" class="needs-validation-loading" novalidate autocomplete="off">                    
                    <input name="id" id="id-altera-contato" hidden>
                    <input name="method" value="update" hidden>
                    <input name="id-usuario" value="<?=$_SESSION['id_usuario'];?>" hidden>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="altera-nome-contato" class="label-cadastro col-form-label">Nome Responsável</label>
                                <input name="nome" type="text" class="form-control" id="altera-nome-contato" required>
                                <div class="invalid-feedback">
                                    Campo Obrigatório
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="altera-email-contato" class="label-cadastro col-form-label">Email</label>
                                <input name="email" type="text" class="form-control" id="altera-email-contato" required>
                                <div class="invalid-feedback">
                                    Campo Obrigatório
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="altera-telefone-contato" class="label-cadastro col-form-label">Telefone</label>
                                <input name="telefone" type="text" class="form-control" id="altera-telefone-contato" required>
                                <div class="invalid-feedback">
                                    Campo Obrigatório
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-padrao btn-warning font-weight-bold" type="submit">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>