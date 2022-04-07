<div class="modal fade bd-example-modal-lg" id="osTipo5" tabindex="-1" role="dialog" aria-labelledby="osTipo5" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="exampleModalLabel">Selecione quais certidões você deseja solicitar</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 mb-3 text-center">
                        <button type="button" class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block" data-toggle="modal" data-dismiss="modal" data-target="#modalSocio">Sócios</button>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <button type="button" class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block" data-toggle="modal" data-dismiss="modal" data-target="#modalEndereco">Alterar Endereço</button>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <button type="button" class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block" data-toggle="modal" data-dismiss="modal" data-target="#modalAtividade">Atividades</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3 text-center">
                        <button type="button" class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block" data-toggle="modal" data-dismiss="modal" data-target="#modalNomeEmpresa">Alterar Nome da Empresa</button>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <button type="button" class="btn btn-padrao btn-lg btn-cor-accent-secundaria btn-block" data-toggle="modal" data-dismiss="modal" data-target="#modalBaixaEmpresa">Baixa da Empresa</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/alterar-nome-empresa.php' ?>
<?php include __DIR__ . '/atividade.php' ?>
<?php include __DIR__ . '/baixa.php' ?>
<?php include __DIR__ . '/alterar-endereco.php' ?>