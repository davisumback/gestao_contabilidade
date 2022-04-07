<?php
$codigoServico = new \App\Model\Empresa\ConsultaCodigoServico();
$codigos = $codigoServico->all();

$empresa = new \App\Model\Empresa\Empresa();
$empresaDados = $empresa->getCnpjRazaoSocial($empresasId);

if (array_key_exists('empresasId', $_COOKIE) || $empresasId != null) {
    $consulta = new \App\Model\Empresa\ConsultaContaBancaria();
    $conta = $consulta->getContaBancariaPadrao($empresasId);
}
?>

<div class="modal fade bd-example-modal-lg" id="emite" tabindex="-1" role="dialog" aria-labelledby="emite" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cor-primaria">
                <h5 class="modal-title" id="exampleModalLabel">Emitir Nota Fiscal</h5>
            </div>
            <form class="needs-validation-loading" action="../controllers/nfse/nota-fiscal.php" method="post" autocomplete="off" novalidate>
                <input name="empresasId" value="<?=$empresasId?>">
                <input name="method" value="emite">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <label class="label-cadastro">Valor da Nota</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input name="valorNota" type="text" class="form-control real" required maxlength="10">
                                <div class="invalid-feedback">
                                    Campo Obrigatório.
                                </div>
                            </div>
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