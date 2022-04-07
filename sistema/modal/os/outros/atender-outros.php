<div class="modal fade" id="atender-outros" tabindex="-1" role="dialog" aria-labelledby="atender-outros" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Outros</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post" novalidate enctype="multipart/form-data" autocomplete="none">
                    <input name="method" value="atendeOsOutros" hidden>
                    <input name="usuariosId" value="<?=$_SESSION['id_usuario']?>" hidden>
                    <input name="ordemDeServicoId" value="<?=$_GET['os']?>" hidden>

                    <div class="row">
                        <div class="col-12">
                            <h5 class="label-cadastro">Você tem certeza que deseja finalizar essa O.S?</h5>
                        </div>
                    </div>

                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-padrao btn-cor-primaria"><strong>Finalizar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>