<div class="modal fade" id="osTipo7" tabindex="-1" role="dialog" aria-labelledby="osTipo7" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" >Nova Solicitação de Rendimento</h5>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-12">

                        <?php if (empty($socios)) : ?>
                            <h5 class="text-center text-info">Sem Socios</h5>
                        <?php else : ?>
                            <div class="table-responsive">                    
                                <table class="table mt-3 table table-hover">
                                    <thead class="bg-info">
                                        <tr class="text-white">
                                            <th scope="col">Nome</th>
                                            <th scope="col">Sócio Administrador</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($socios as $socio) : ?>
                                            <tr style="cursor:pointer;" onclick="submitForm()">
                                                <td class="text-secondary font-weight-bold"><?=$socio['nome_completo']?></td>
                                                <td class="text-secondary font-weight-bold">
                                                    <?= $socio['socio_administrador'] == 1 ? "Sim" : "Não" ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif ?>
                        <!-- <div class="table-responsive" id="tableSocios">
                            <table id="myTable" class="mt-5 table table-bordered table-hover">
                                <thead class="label-cadastro">
                                    <tr class="table-success text-center" role="row">
                                        <th scope="col">Nome</th>
                                        <th scope="col">Sócio Administrador</th>
                                    </tr>
                                </thead>
                                <tbody class="label-cadastro text-success">
                                    <tr style="cursor:pointer;" onclick="submitForm('+socios[x].id+', '+empresasId+')">
                                        <td> +socios[x].nome_completo+ '</td>
                                        <td>' +(socios[x].socio_administrador == 1 ? "Sim" : "Não")+ '</td>
                                    <tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                </div>
            </div>

            <form id="formSociosEmpresa" class="needs-validation-loading" action="../controllers/ordem-servico/admin.php" method="post">
                <input name="method" value="storeOsDeclaracaoRendimentosMedcontabil" hidden>
                <input id="usuariosId" name="usuariosId" hidden>
                <input id="empresasId" name="empresasId" value="<?=$empresasId?>" hidden>
                <input name="tipoOs" value="<?=$_GET['tipoOs']?>" hidden>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-padrao" data-dismiss="modal"><strong>Fechar</strong></button>
            </div>
        </div>
    </div>
</div>