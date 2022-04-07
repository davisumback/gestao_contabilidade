<?php
$codigoServico = new \App\Model\Empresa\ConsultaCodigoServico();
$codigos = $codigoServico->all();

$empresa = new \App\Model\Empresa\Empresa();
$empresaDados = $empresa->getCnpjRazaoSocial($empresasId);

// $consulta = new \App\Model\Empresa\ConsultaContaBancaria();
// $conta = $consulta->getContaBancariaPadrao($empresasId);
?>

<div class="modal fade bd-example-modal-lg" id="emite" role="dialog" aria-labelledby="emite" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="exampleModalLabel">Emissão de Nota Fiscal</h5>
            </div>
            <form class="needs-validation-loading" action="../controllers/nfse/nota-fiscal.php" method="post" autocomplete="off" novalidate>
                <input name="empresasId" value="<?=$empresasId?>" hidden>
                <input name="method" value="emitePresumido" hidden>
                <input name="caminhoRetorno" value="nota-fiscal.php?empresasId=<?=$empresasId?>" hidden>

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
                                            <input readonly onkeyup="calculaIss('issAliquota', 'issValor', 'issRetido')" value='0' id="issAliquota" name="issAliquota" type="text" class="form-control aliquota">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input readonly value='0' id='issValor' name="issValor" type="text" class="form-control real">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-center">
                                                <input onchange="calculaIss('issAliquota', 'issValor', 'issRetido')" type="checkbox" id="issRetido">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='label-cadastro align-middle'>PIS</td>
                                        <td class='align-middle'>
                                            <input readOnly value='0' id="pisAliquota" name="pisAliquota" type="text" class="form-control aliquota" maxlength="10">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input readOnly value='0' id='pisValor' name="pisValor" type="text" class="form-control real" maxlength="10">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-center">
                                                <input onchange="calculaAliquotas('pisAliquota', 'pisValor', 'pisRetido', 0.65)" type="checkbox" id="pisRetido">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='label-cadastro align-middle'>COFINS</td>
                                        <td class='align-middle'>
                                            <input readOnly value='0' id="cofinsAliquota" name="cofinsAliquota" type="text" class="form-control aliquota">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input readOnly value='0' id='cofinsValor' name="cofinsValor" type="text" class="form-control real">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-center">
                                                <input onchange="calculaAliquotas('cofinsAliquota', 'cofinsValor', 'cofinsRetido', 3)" type="checkbox" id="cofinsRetido">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='label-cadastro align-middle'>CSLL</td>
                                        <td class='align-middle'>
                                            <input readOnly value='0' id="csllAliquota" name="csllAliquota" type="text" class="form-control aliquota">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input readOnly value='0' id='csllValor' name="csllValor" type="text" class="form-control real">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-center">
                                                <input onchange="calculaAliquotas('csllAliquota', 'csllValor', 'csllRetido', 1)" type="checkbox" id="csllRetido">
                                            </div>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td class='label-cadastro align-middle'>IRRF</td>
                                        <td class='align-middle'>
                                            <input readOnly value='0' id="irrfAliquota" name="irrfAliquota" type="text" class="form-control aliquota">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input readOnly value='0' id='irrfValor' name="irrfValor" type="text" class="form-control real" maxlength="10">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-center">
                                                <input onchange="calculaAliquotas('irrfAliquota', 'irrfValor', 'irrfRetido', 1.5)" type="checkbox" id="irrfRetido">
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
                            <textarea name="descricao" rows="8" cols="50" class="form-control" required>Honorários médicos referente à serviços prestados.&#10Banco: <?=$conta->getBanco()->getNome()?> - <?=$conta->getBanco()->getCod();?>&#10Agência: <?=$conta->getAgencia()?>&#10Conta: <?=$conta->getNumero()?> - <?=$conta->getDigito()?>&#10<?=$empresaDados['razaoSocial']?></textarea>
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
        </div>
    </div>
</div>

<script src="../assets/custom-js/helpers.js"></script>

<script>
    var divAliquotas = document.getElementById('divAliquotas');
    var valorTotalNota = document.getElementById("valorTotalNota");

    function toogleAliquotas(element) {
        if (element.value.length > 0) {
            divAliquotas.removeAttribute('hidden');
            calculaIss('issAliquota', 'issValor', 'issRetido');
            calculaAliquotas('pisAliquota', 'pisValor', 'pisRetido', 0.65);
            calculaAliquotas('cofinsAliquota', 'cofinsValor', 'cofinsRetido', 3);
            calculaAliquotas('csllAliquota', 'csllValor', 'csllRetido', 1);
            calculaAliquotas('irrfAliquota', 'irrfValor', 'irrfRetido', 1.5);
            
            return;
        }

        divAliquotas.setAttribute('hidden', 'true');
    }

    function calculaIss(idAliquota, idValor, idcheckBox) {
        var aliquota = document.getElementById(idAliquota);
        var valor = document.getElementById(idValor);

        toogleRetido(idcheckBox, aliquota, valor);

        if (aliquota.value == 0 || valorTotalNota.value == 0) {
            valor.value = 0;
            return;
        }
        
        valor.value = numeroParaMoeda((aliquota.value / 100) * formataMoedaBd(valorTotalNota.value), 2, ',', '.');
    }

    function calculaAliquotas(idAliquota, idValor, idcheckBox, valorAliquota) {
        var aliquota = document.getElementById(idAliquota);
        var valor = document.getElementById(idValor);
        var checkBox = document.getElementById(idcheckBox);

        if (checkBox.checked == false) {
            aliquota.value = 0;
            valor.value = 0;
            return;
        }

        aliquota.value = valorAliquota;

        if (valorTotalNota.value == 0) {
            valor.value = 0;
            return;
        }
        
        valor.value = numeroParaMoeda((valorAliquota / 100) * formataMoedaBd(valorTotalNota.value), 2, ',', '.');
    }

    function toogleRetido(idcheckBox, aliquotaElement, valorElement) {
        var checkBox = document.getElementById(idcheckBox);

        if (checkBox.checked) {
            aliquotaElement.removeAttribute('readOnly');
            valorElement.removeAttribute('readOnly');
            return;
        }

        aliquotaElement.value = 0;
        valorElement.value = 0;
        aliquotaElement.setAttribute('readOnly', 'true');
        valorElement.setAttribute('readOnly', 'true');
    }
</script>