<?php

use App\Helper\Helpers;
use App\Helper\EstadoCivil;
use App\Helper\Mensagem;
use App\DAO\EmpresaAcessoDAO;
use App\DAO\EmpresasPlanosDAO;
use App\DAO\EmpresaUsuarioCongDAO;
use App\Arquivo\NavegadorArquivos;
use App\Model\Empresa\EmpresaContaBancaria;
use App\Model\Empresa\Certidoes;
use App\Model\Empresa\Alvara;
use App\Model\Empresa\EmpresaAliquota;
use App\DAO\EmpresaFaturamentoDAO;

require_once('header.php');
require_once('menu-topo.php');

if(!array_key_exists('viewIdEmpresa', $_SESSION)){
    header("Location: empresa-pesquisa.php");
    die();
}

$dadosEmpresa = json_decode($_SESSION['infosEmpresa'], true);

$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa'] . ' | ' . $dadosEmpresa[0]['cnpj']);
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new EmpresaAcessoDAO();
$acessos = $dao->getAcessos($dadosEmpresa[0]['id']);

$dao = new EmpresasPlanosDAO();
$planos = $dao->getPlanos($_SESSION['viewIdEmpresa']);

$dao = new EmpresaUsuarioCongDAO();
$isEmpresaCongelada = $dao->isEmpresaCongelada($_SESSION['viewIdEmpresa']);

$dao = new EmpresaContaBancaria();
$contaBancaria = $dao->getContasBancarias($_SESSION['viewIdEmpresa']);

$dao = new Certidoes();
$certidoes = $dao->getCertidoes($_SESSION['viewIdEmpresa']);

$empresaFaturamentoDao = new EmpresaFaturamentoDAO();
$faturamentos = $empresaFaturamentoDao->getFaturamentos($_SESSION['viewIdEmpresa'], 12);

$dao = new Alvara();
$alvara = $dao->getAlvara($_SESSION['viewIdEmpresa']);

$dao = new EmpresaAliquota();
$aliquota = $dao->getIss($_SESSION['viewIdEmpresa']);

$dao = new Certidoes();
for ($i=1; $i < 10; $i++) {
    $retorno = $dao->getCertidoesAtuais($_SESSION['viewIdEmpresa'], $i);
    if ($retorno != null) {
        $certidoesAtuais[$i] = $retorno;        
    }
}
?>

<div id="carregando" class="center display-none">
    <div class="loading">
    </div>
</div>
<div class="container-fluid pb-1" id="conteudo">
    <div class="text-center mt-1">
        <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao_acesso', 'mensagem_insercao_acesso');?>
    </div>
</div>
<div class="container-fluid">
    <div class="content px-0" id="conteudo">
        <div class="row justify-content-around">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-cor-accent-primaria py-2">
                        <div class="col-6 pl-0 mt-1">
                            <i class="fa fa-user"></i><strong class="card-title pl-md-2">Perfil Empresa</strong>                        
                        </div>
                        <div class="col-6 text-right">
                            <button data-toggle="modal" data-target="#congela-empresa" type="button" class="font-weight-bold btn btn-padrao btn-sm <?=($isEmpresaCongelada) ? 'btn-success' : 'btn-secondary'?>">
                                <?=($isEmpresaCongelada) ? 'Descongelar' : 'Congelar'?>
                            </button>                        
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <h6 class="label-cadastro">Nome</h6>
                                <?php foreach ($dadosEmpresa as $dadoEmpresa) : ?>
                                    <h6 class="text-dark mt-1"> <?=$dadoEmpresa['nome_completo']?></h6>                                    
                                <?php endforeach ?>
                            </div>
                            <div class="col-md-4">
                                <h6 class="label-cadastro">Email</h6>
                                <?php foreach ($dadosEmpresa as $dadoEmpresa) : ?>
                                    <h6 class="text-dark mt-1"> <?=$dadoEmpresa['email']?></h6>                                    
                                <?php endforeach ?>
                            </div>                           
                            <div class="col-md-4">
                                <h6 class="label-cadastro">Regime Tributário</h6>
                                <h6 class="text-dark mt-1"><?=($dadosEmpresa[0]['regime_tributario'] == 'SN')? 'Simples Nacional' : 'Presumido'?></h6>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-4">
                                <div class="row mt-3">                         
                                    <div class="col-md-12">
                                        <?php if ($contaBancaria == true) : ?>                                    
                                            <h6 class="label-cadastro">Dados Bancários</h6>
                                            <h6 class="text-dark mt-1">Banco: <?=$contaBancaria[0]['nome'] .' <br> Agência: '. $contaBancaria[0]['agencia'] .'<br> Conta: '. $contaBancaria[0]['numero'] .'-'. $contaBancaria[0]['digito']?></h6>
                                        <?php endif ?>
                                    </div>                                                                                               
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">                                    
                                        <h6 class="label-cadastro mb-1">Emissor Prefeitura</h6>
                                        <?php foreach ($acessos as $arraychaves => $arrayDados) : ?>
                                            <h6 class="mb-1">
                                                Site: 
                                                <a href="<?=$arrayDados['site']?>" class="" target="_blank"><?=$arrayDados['site']?></a>
                                            </h6>                                    
                                            <h6 class="mb-1">Login: <?=$arrayDados['login']?></h6>
                                            <h6>Senha: <?=$arrayDados['senha']?></h6>
                                        <?php endforeach ?>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h6 class="label-cadastro">Vencimento Certidões</h6>
                                <h6 class="text-dark mt-1">
                                    <?php foreach ($certidoesAtuais as $certidao => $arrayDados) : ?>
                                        <?=$arrayDados['nome'] ?>: <span class="badge badge-secondary mt-2"><?=Helpers::formataDataView($arrayDados['data_validade']) ?></span>
                                        <br>
                                    <?php endforeach ?> 
                                    Alvará: <span class="badge badge-secondary mt-2"><?=Helpers::formataDataView($alvara['data_vencimento']) ?></span>
                                </h6>
                            </div>
                            <div class="col-md-4 offset-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="label-cadastro">Honorários</h6>
                                        <h6> <span class="badge badge-success mt-1">Em dia</span></h6>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h6 class="label-cadastro">Impostos</h6>
                                        <h6 class="mt-2"> 
                                            <span class="badge badge-success mt-1">Em dia</span>
                                            <span class="badge badge-secondary">Competência: <?=Helpers::formataDataCompetenciaView($_SESSION['dataCompetencia'])?></span>
                                        </h6>
                                        <h6><span class="badge badge-secondary mt-1">Impostos: 23%</span> <span class="badge badge-secondary mt-1">ISS: <?=$aliquota['aliquota']?> %</span></h6>
                                    </div>                                
                                </div>                                                         
                            </div>                                                   
                        </div>                        
                        <div class="row pt-3">
                            <div class="col-md-2 px-2">
                                <button class="btn btn-padrao btn-success btn-sm btn-block font-weight-bold text-white" type="button" data-toggle="modal" data-target="#envia-email-nf">
                                    Enviar NFSe
                                </button>
                            </div>
                            <div class="col-md-2 px-2">
                                <a class="btn btn-padrao btn-success btn-sm btn-block font-weight-bold text-white" href="ordem-servico-lista.php?method=getAllEmitidas&view=all&tipoOs=all&status=all&periodo=30">
                                    Ordem Serviço
                                </a>
                            </div>
                            <div class="col-md-2 px-2"> 
                                <a class="btn btn-padrao btn-success btn-sm btn-block font-weight-bold text-white" href="empresa-arquivos.php">
                                    Documentos
                                </a>
                            </div>
                            <div class="col-md-2 px-2">
                                <button class="btn btn-padrao btn-success btn-sm btn-block font-weight-bold text-white" type="button" data-toggle="modal" data-target="#lista-faturamento">
                                    Faturamento
                                </button>
                            </div>
                            <div class="col-md-2 px-2">
                                <button class="btn btn-padrao btn-success btn-sm btn-block font-weight-bold text-white" type="button" data-toggle="modal" data-target="#rendimento-home">
                                    Declaração Renda
                                </button>
                            </div>
                            <div class="col-md-2 px-2">
                                <button class="btn btn-padrao btn-success btn-sm btn-block font-weight-bold text-white" type="button" data-toggle="modal" data-target="#rendimento-home">
                                    Rend. Pessoa Física
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/empresa/email/envia-email-nf.php';?>
<?php include __DIR__ . '/../modal/empresa/declaracaorendimento-home.php';?>
<?php include __DIR__ . '/../modal/empresa/faturamento/lista-faturamento.php';?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script src="../assets/custom-js/loading-automatico.js" charset="utf-8"></script>

<script type="text/javascript">
    $('#data-competencia').mask('00/0000');
</script>