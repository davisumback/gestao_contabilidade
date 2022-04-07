<?php
$codigoServico = new \App\Model\Empresa\ConsultaCodigoServico();
$codigos = $codigoServico->all();

$empresa = new \App\Model\Empresa\Empresa();
$empresaDados = $empresa->getCnpjRazaoSocial($empresasId);

$consulta = new \App\Model\Empresa\ConsultaContaBancaria();
$conta = $consulta->getContaBancariaPadrao($empresasId);
?>

<div class="modal fade bd-example-modal-lg" id="emite" tabindex="-1" role="dialog" aria-labelledby="emite" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="exampleModalLabel">Emissão de Nota Fiscal</h5>
            </div>
            <form class="needs-validation-loading" action="../controllers/nfse/nota-fiscal.php" method="post" autocomplete="off" novalidate>
                <input name="empresasId" value="<?=$empresasId?>">
                <input name="method" value="emitePresumido">
                <input id='inputRetencoes' name='retencoes' value='false'>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mx-auto text-center">
                            <label class="label-cadastro">Valor da Nota</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input onkeyup="toogleRetido(this)" id='valorTotalNota' name="valorNota" type="text" class="form-control real" required maxlength="10">
                                <div class="invalid-feedback">
                                    Campo Obrigatório.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id='divRetido' hidden>                        
                        <div class="col-sm-12 mx-auto">
                            <div class="form-check text-center">
                                <input onchange="toogleAliquotas()" class="form-check-input" type="checkbox" id="retidoCheck">
                                <label class="form-check-label label-cadastro" for="retidoCheck">
                                    Retido
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="retencoes">
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
                                            <input onkeyup="calculaValorAliquota('issAliquota', 'inssValor')" value='0' id="inssAliquota" name="inssAliquota" type="text" class="form-control aliquota" maxlength="10">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input value='0' id='issValor' name="issValor" type="text" class="form-control real" maxlength="10">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-center">
                                                <input onchange="calculaValorAliquota('issAliquota', 'issValor')" type="checkbox" id="retidoCheck">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='label-cadastro align-middle'>PIS</td>
                                        <td class='align-middle'>
                                            <input onkeyup="calculaValorAliquota('pisAliquota', 'pisValor')" value='0' id="pisAliquota" name="pisAliquota" type="text" class="form-control aliquota" maxlength="10">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input value='0' id='pisValor' name="pisValor" type="text" class="form-control real" maxlength="10">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='label-cadastro align-middle'>COFINS</td>
                                        <td class='align-middle'>
                                            <input onkeyup="calculaValorAliquota('cofinsAliquota', 'cofinsValor')" value='0' id="cofinsAliquota" name="cofinsAliquota" type="text" class="form-control aliquota" maxlength="10">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input value='0' id='cofinsValor' name="cofinsValor" type="text" class="form-control real" maxlength="10">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='label-cadastro align-middle'>CSLL</td>
                                        <td class='align-middle'>
                                            <input onkeyup="calculaValorAliquota('csllAliquota', 'csllValor')" value='0' id="csllAliquota" name="csllAliquota" type="text" class="form-control aliquota" maxlength="10">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input value='0' id='csllValor' name="csllValor" type="text" class="form-control real" maxlength="10">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td class='label-cadastro align-middle'>IRRF</td>
                                        <td class='align-middle'>
                                            <input onkeyup="calculaValorAliquota('irrfAliquota', 'irrfValor')" value='0' id="irrfAliquota" name="irrfAliquota" type="text" class="form-control aliquota" maxlength="10">
                                            <div class="invalid-feedback">
                                                Campo Obrigatório.
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input value='0' id='irrfValor' name="irrfValor" type="text" class="form-control real" maxlength="10">
                                                <div class="invalid-feedback">
                                                    Campo Obrigatório.
                                                </div>
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
                            <textarea name="descricao" rows="8" cols="50" class="form-control" type="text" required>Honorários médicos referente à serviços prestados.&#10Banco: <?=$conta->getBanco()->getNome()?> - <?=$conta->getBanco()->getCod();?>
                                &#10Agência: <?=$conta->getAgencia()?>
                                &#10Conta: <?=$conta->getNumero()?> - <?=$conta->getDigito()?>
                                &#10<?=$empresaDados['razaoSocial']?>
                            </textarea>
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
    var divRetido = document.getElementById('divRetido');
    var retidoCheck = document.getElementById('retidoCheck');
    var valorTotalNota = document.getElementById("valorTotalNota");

    function toogleRetido(element) {
        if (element.value.length > 0) {
            divRetido.removeAttribute('hidden');
            calculaValorAliquota('pisAliquota', 'pisValor');
            calculaValorAliquota('cofinsAliquota', 'cofinsValor');
            calculaValorAliquota('csllAliquota', 'csllValor');
            calculaValorAliquota('inssAliquota', 'inssValor');
            calculaValorAliquota('irrfAliquota', 'irrfValor');
            return;
        }

        divRetido.setAttribute('hidden', 'true');
        toogleAliquotas();
        retidoCheck.checked = false;
    }

    function calculaValorAliquota(idAliquota, idValor) {
        var aliquota = document.getElementById(idAliquota);
        var valor = document.getElementById(idValor);

        if (aliquota.value == 0 || valorTotalNota.value == 0) {
            valor.value = 0;
            return;
        }       

        valor.value = numeroParaMoeda((aliquota.value / 100) * formataMoedaBd(valorTotalNota.value), 2, ',', '.');
    }

    function toogleAliquotas() {
        var divRetencoes = document.getElementById("retencoes");
        var inputRetencoes = document.getElementById("inputRetencoes");

        var pisAliquota = document.getElementById("pisAliquota");
        var pisValor = document.getElementById("pisValor");
        var cofinsAliquota = document.getElementById("cofinsAliquota");
        var cofinsValor = document.getElementById("cofinsValor");
        var csllAliquota = document.getElementById("csllAliquota");
        var csllValor = document.getElementById("csllValor");
        var inssAliquota = document.getElementById("inssAliquota");
        var inssValor = document.getElementById("inssValor");
        var irrfAliquota = document.getElementById("irrfAliquota");
        var irrfValor = document.getElementById("irrfValor");

        if (divRetencoes.hidden) {
            divRetencoes.removeAttribute('hidden');
            pisAliquota.setAttribute('required', 'true');
            pisValor.setAttribute('required', 'true');
            cofinsAliquota.setAttribute('required', 'true');
            cofinsValor.setAttribute('required', 'true');
            csllAliquota.setAttribute('required', 'true');
            csllValor.setAttribute('required', 'true');
            inssAliquota.setAttribute('required', 'true');
            inssValor.setAttribute('required', 'true');
            irrfAliquota.setAttribute('required', 'true');
            irrfValor.setAttribute('required', 'true');
            inputRetencoes.value = 'true';
            return;
        }
        
        divRetencoes.setAttribute('hidden', 'true');
        pisAliquota.removeAttribute('required');
        pisValor.removeAttribute('required');
        cofinsAliquota.removeAttribute('required');
        cofinsValor.removeAttribute('required');
        csllAliquota.removeAttribute('required');
        csllValor.removeAttribute('required');
        inssAliquota.removeAttribute('required');
        inssValor.removeAttribute('required');
        irrfAliquota.removeAttribute('required');
        irrfValor.removeAttribute('required');
        inputRetencoes.value = 'false';
    }
</script>