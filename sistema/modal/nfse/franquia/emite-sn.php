<?php
$codigoServico = new \App\Model\Empresa\ConsultaCodigoServico();
$codigos = $codigoServico->all();

$empresa = new \App\Model\Empresa\Empresa();
$empresaDados = $empresa->getCnpjRazaoSocial($empresasId);

// $consulta = new \App\Model\Empresa\ConsultaContaBancaria();
// $conta = $consulta->getContaBancariaPadrao($empresasId);
?>

<div class="modal fade bd-example-modal-lg" id="emite" tabindex="-1" role="dialog" aria-labelledby="emite" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="exampleModalLabel">Emissão de Nota Fiscal</h5>
            </div>

            <?php if ($aliquotaIssSimplesNacional == null) : ?>
                <div class="col-12 mt-5">
                    <div class="alert alert-secondary text-center" role="alert">
                        <strong>Não existe alíquota cadastrada no sistema para sua empresa.</strong>
                    </div>
                </div>
            <?php else : ?>
                <form class="needs-validation-loading" action="../controllers/nfse/nota-fiscal.php" method="post" autocomplete="off" novalidate>
                    <input name="empresasId" value="<?=$empresasId?>" hidden>
                    <input name="method" value="emiteSimplesNacional" hidden>
                    <input name="caminhoRetorno" value="nota-fiscal.php" hidden>                

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mx-auto text-center">
                                <label class="label-cadastro">Valor da Nota</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input onkeyup="toogleAliquotas(this)" id='valorTotalNota' name="valorNota" type="text" class="form-control real" required maxlength="10">
                                    <div class="invalid-feedback">
                                        Campo Obrigatório.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="divAliquotas" hidden>
                            <div class="row">
                                <table class="table tabela-sem-borda">
                                    <thead>
                                        <tr class='text-center label-cadastro'>
                                            <th scope="col"></th>
                                            <th scope="col">Alíquota %</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Retido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class='label-cadastro align-middle'>ISS</td>
                                            <td class='align-middle'>
                                                <input readOnly value="0" id="issAliquota" name="issAliquota" type="text" class="form-control aliquota" maxlength="10">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">R$</span>
                                                    </div>
                                                    <input readOnly value="0" id='issValor' name="issValor" type="text" class="form-control real" maxlength="10">
                                                    <div class="invalid-feedback">
                                                        Campo Obrigatório.
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="text-center">
                                                    <input onchange="toogleRetido('issRetido', 'issAliquota', 'issValor')" type="checkbox" id="issRetido">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>    
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-5 autocomplete">
                                <label class="label-cadastro">Código de Serviço</label>
                                <select class="form-control" name="codigoServico" required>
                                    <option value="">Escolha...</option>
                                    <?php foreach ($codigos as $codigo) : ?>
                                        <option value="<?=$codigo->getCodigoServico()?>"><?=$codigo->getCodigoServico()?> - <?=$codigo->getNome()?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    Campo Obrigatório.
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label class="label-cadastro">CNPJ do Tomador</label>
                                <input name="cnpjTomador" class="form-control cnpj" type="text" required>
                                <div class="invalid-feedback">
                                    Campo Obrigatório.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-10 mx-auto">
                                <label class="label-cadastro">Descrição</label>
                                <textarea name="descricao" rows="8" cols="50" class="form-control" type="text" required>Honorários médicos referente à serviços prestados.&#10Banco: <?=$conta->getBanco()->getNome()?> - <?=$conta->getBanco()->getCod();?>&#10Agência: <?=$conta->getAgencia()?>&#10Conta: <?=$conta->getNumero()?> - <?=$conta->getDigito()?>&#10<?=$empresaDados['razaoSocial']?></textarea>
                                <div class="invalid-feedback">
                                    Campo Obrigatório.
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-5 mx-auto text-center">
                                <label class="label-cadastro">Email para envio da NFS-e</label>
                                <input name="emailTomador" class="form-control" required>
                                <div class="invalid-feedback">
                                    Campo Obrigatório.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-padrao btn-cor-primaria">Emitir</button>
                        <button type="button" class="btn btn-padrao btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
                
                <script src="../assets/custom-js/helpers.js"></script>

                <script>
                    var divAliquotas = document.getElementById('divAliquotas');
                    var valorTotalNota = document.getElementById("valorTotalNota");

                    function toogleAliquotas(element) {
                        if (element.value.length > 0) {
                            divAliquotas.removeAttribute('hidden');            
                            return;
                        }

                        divAliquotas.setAttribute('hidden', 'true');
                    }

                    function calculaIss() {
                        var valor = document.getElementById('issValor');
                        var issAliquota = document.getElementById('issAliquota');

                        var aliquota = <?=$aliquotaIssSimplesNacional?>

                        valor.value = numeroParaMoeda((aliquota / 100) * formataMoedaBd(valorTotalNota.value), 2, ',', '.');
                        issAliquota.value = <?=$aliquotaIssSimplesNacional?>;
                    }

                    function toogleRetido(idcheckBox, aliquotaId, valorId) {
                        var checkBox = document.getElementById(idcheckBox);
                        var aliquotaElement = document.getElementById(aliquotaId);
                        var valorElement = document.getElementById(valorId);

                        if (checkBox.checked) {
                            calculaIss();
                            return;
                        }

                        aliquotaElement.value = 0;
                        valorElement.value = 0;
                    }
                </script>
            <?php endif ?>
        </div>
    </div>
</div>

