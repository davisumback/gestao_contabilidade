<?php

use \App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

$empresa = new \App\Model\Empresa\Empresa();
$dadosEmpresa = $empresa->getDadosEmpresaMedcontabil($_SESSION['empresasId']);

$totalHonorarios = $empresa->empresaPlanos($_SESSION['empresasId']);

?>

<div class="container-fluid">
    <div class="content mt-3" id="conteudo">
        <div class="row justify-content-around">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-cor-accent-primaria">
                        <i class="fa fa-user"></i><strong class="card-title pl-md-2">Dados Cadastrais</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <h5 class="text-sm-center mt-2 mb-1"><?=$dadosEmpresa[0]['nome_empresa']?></h5>
                            <div class="location text-sm-center"><i class="fas fa-map-marker-alt"></i> <?=$dadosEmpresa[0]['cidade']?>, <?=$dadosEmpresa[0]['endereco_uf']?></div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>IPTU</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['iptu']?></p>
                            </div>
                            <div class="col-md-6">
                                <h6>CEP</h6>
                                <p class="text-dark mt-1"><?=Helpers::mask($dadosEmpresa[0]['cep'], '#####-###')?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Logradouro</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['logradouro']?></p>
                            </div>
                            <div class="col-md-4">
                                <h6>Número</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['numero']?></p>
                            </div>
                            <div class="col-md-4">
                                <h6>Bairro</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['bairro']?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h6>Complemento</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['complemento']?></p>
                            </div>
                            <div class="col-md-4">
                                <h6>Cidade</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['cidade']?></p>
                            </div>
                            <div class="col-md-4">
                                <h6>UF</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['endereco_uf']?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>CNPJ</h6>
                                <p class="text-dark mt-1"><?=Helpers::mask($dadosEmpresa[0]['cnpj'], '##.###.###/####-##')?></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Tipo Societário</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['tipo_societario']?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Regime Tributário</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['regime_tributario']?></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Sócio Administrador</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['nome_completo']?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Vencimento Honorários</h6>
                                <p class="text-dark mt-1">Dia <?=$dadosEmpresa[0]['dia_vencimento']?></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Total Honorários</h6>
                                <p class="text-dark mt-1">R$ <?=Helpers::formataMoedaView($totalHonorarios)?></p>
                            </div>
                        </div>

                        <hr>

                        <div class="row my-4">
                            <div class="col text-center">
                                <h3>Socios</h3>
                            </div>
                        </div>

                        <?php foreach ($dadosEmpresa as $dadoChave => $dado) : ?>                        
                            <div class="row mb-2 mt-4">
                                <div class="col-md-6">
                                    <h6>Sócio <?=(sizeof($dadosEmpresa) == 1) ? '' : $dadoChave+1?></h6>
                                    <p class="text-dark mt-1"><?=$dado['nome_completo']?></p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Porcentagem Societária</h6>
                                    <p class="text-dark mt-1"><?=$dado['porcentagem_societaria']?></p>
                                </div>
                            </div>                            

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>CPF</h6>
                                    <p class="text-dark mt-1"><?=$dado['cpf']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Email</h6>
                                    <p class="text-dark mt-1"><?=$dado['email']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>CRM</h6>
                                    <p class="text-dark mt-1"><?=$dado['crm']?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Data de Nascimento</h6>
                                    <p class="text-dark mt-1"><?=Helpers::formataDataView($dado['data_nascimento'])?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Telefone Celular</h6>
                                    <p class="text-dark mt-1"><?=Helpers::mask($dado['telefone_celular'], "(##) #####-####")?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Telefone Comercial</h6>
                                    <p class="text-dark mt-1"><?=Helpers::mask($dado['telefone_comercial'], "(##) #####-####")?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Estado Civil</h6>
                                    <p class="text-dark mt-1"><?=$dado['estado_civil']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Regime de Casamento</h6>
                                    <p class="text-dark mt-1"><?=$dado['regime_casamento']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Profissão</h6>
                                    <p class="text-dark mt-1"><?=$dado['profissao']?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Documento Cadastrado</h6>
                                    <p class="text-dark mt-1"><?=$dado['tipo_documento']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Número do Documento</h6>
                                    <p class="text-dark mt-1"><?=$dado['doc_numero']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Data de Emissão</h6>
                                    <p class="text-dark mt-1"><?=Helpers::formataDataView($dado['data_emissao'])?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Órgão Expedidor</h6>
                                    <p class="text-dark mt-1"><?=$dado['orgao_expedidor']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Validade</h6>
                                    <p class="text-dark mt-1"><?=$dado['validade']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>UF</h6>
                                    <p class="text-dark mt-1"><?=$dado['doc_uf']?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Naturalidade</h6>
                                    <p class="text-dark mt-1"><?=$dado['naturalidade']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>IES</h6>
                                    <p class="text-dark mt-1"><?=$dado['ies_nome']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Cidade IES</h6>
                                    <p class="text-dark mt-1"><?=$dado['ies_cidade']?></p>
                                </div>
                            </div>

                            <?php if (sizeof($dadosEmpresa) > 1 && $dadoChave < sizeof($dadosEmpresa) - 1) : ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="linha"></div>
                                    </div>
                                </div>
                            <?php endif?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
require_once('../modal/cliente-medcontabil/dados-perfil.php');
?>
