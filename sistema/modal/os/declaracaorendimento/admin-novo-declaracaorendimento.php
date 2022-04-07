

<div class="modal fade" id="osTipo7" tabindex="-1" role="dialog" aria-labelledby="osTipo7" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" >Nova Solicitação de Rendimento</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <label class="label-cadastro">Empresa</label>
                        <input id="inputEmpresa" type="text" class="ml-2 text-center col-6 form-control d-inline-block" maxlength="6" autocomplete="off" required>
                        <button id="btnPesquisarSocios" onclick="pesquisarSocios()" type="button" class="btn btn-padrao btn-sm btn-cor-primaria">Pesquisar sócios</button>
                        <div id="invalidFeedbackInputEmpresa" class="ml-5 pl-5 text-left text-danger"></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive" id="tableSocios">
                        </div>
                    </div>
                </div>
            </div>

            <form id="formSociosEmpresa" class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post">
                <input name="method" value="storeOsDeclaracaoRendimentos" hidden>
                <input id="empresasId" name="empresasId" hidden>
                <input id="clientesId" name="clientesId" hidden>
                <input id="usuariosId" name="usuariosId" hidden>
                <input name="tipoOs" value="<?=$_GET['tipoOs']?>" hidden>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
            </div>
        </div>
    </div>
</div>