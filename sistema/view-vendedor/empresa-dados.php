<?php

use App\Helper\Helpers;
use App\Helper\EstadoCivil;
use App\Helper\Mensagem;
use App\DAO\EmpresaAcessoDAO;
use App\DAO\EmpresasPlanosDAO;
use App\DAO\EmpresaUsuarioCongDAO;
use App\Arquivo\NavegadorArquivos;

require_once('header.php');
require_once('menu-topo.php');

if (!array_key_exists('viewIdEmpresa', $_SESSION)) {
    header("Location: empresa-pesquisa.php");
    die();
}

$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']);
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php
$dadosEmpresa = json_decode($_SESSION['infosEmpresa'], true);

$dao = new EmpresaAcessoDAO();
$acessos = $dao->getAcessos($dadosEmpresa[0]['id']);

$dao = new EmpresasPlanosDAO();
$planos = $dao->getPlanos($_SESSION['viewIdEmpresa']);

$dao = new EmpresaUsuarioCongDAO();
$isEmpresaCongelada = $dao->isEmpresaCongelada($_SESSION['viewIdEmpresa']);
?>

<div id="carregando" class="center display-none">
    <div class="loading">
    </div>
</div>

<div class="container-fluid">
    <div class="content " id="conteudo">
        <div class="text-center my-2">
            <?= Mensagem::getMensagem($_COOKIE, 'resultado_insercao_acesso', 'mensagem_insercao_acesso'); ?>
        </div>
        <div class="row justify-content-around">
            <div class="col">
                <div class="card">
                    <div class="card-header <?= ($dadosEmpresa[0]['saiu'] == 1) ? 'bg-warning' : 'bg-cor-accent-primaria' ?>">
                        <i class="fa fa-user"></i><strong class="card-title pl-md-2">Perfil Empresa</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <h5 class="text-sm-center mt-2 mb-1 <?= ($isEmpresaCongelada) ? 'class="text text-danger"' : '' ?>">
                                <?= $dadosEmpresa[0]['id'] . ' | ' . $dadosEmpresa[0]['nome_empresa'] ?>
                                <?= ($isEmpresaCongelada) ? ' (CONGELADA)' : '' ?>
                            </h5>
                            <!-- <div class="location text-sm-center"><i class="fas fa-map-marker-alt"></i> Maring??, Paran??</div> -->
                        </div>
                        <hr>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <h6>CNPJ</h6>
                                <p class="text-dark mt-1"><?=Helpers::mask($dadosEmpresa[0]['cnpj'], "##.###.###/####-##")?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Tipo Societ??rio</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['tipo_societario']?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Gestor</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['gestor']?></p>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <h6>Regime Tribut??rio</h6>
                                <p class="text-dark mt-1"><?=($dadosEmpresa[0]['regime_tributario'] == 'SN')? 'Simples Nacional' : 'Presumido'?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Vencimento Honor??rios</h6>
                                <p class="text-dark mt-1">Dia <?=$dadosEmpresa[0]['dia_vencimento']?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Contador(a)</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['contador']?></p>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <h6>S??cio Administrador</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['nome_completo']?></p>
                            </div>                            
                            <div class="col-md-3">
                                <h6>Total Honor??rios</h6>
                                <p class="text-dark mt-1">
                                    R$
                                    <?php
                                        $valorSaida = 0;
                                        foreach($planos as $chaveArray => $valor) :
                                            $valorSaida += $valor['valor'];
                                    ?>
                                    <?php endforeach ?>
                                    <?=Helpers::formataMoedaView($valorSaida)?>
                                </p>
                            </div>
                            <div class="col-md-3">
                                <h6>Cadastrada Por</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['usuario']?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Data Cadastro</h6>
                                <p class="text-dark mt-1"><?=Helpers::formataDataView($dadosEmpresa[0]['data_cadastro'])?></p>
                            </div>
                        </div>
                        <hr>

                        <!-- ********** ENDERE??O ********** -->
                        
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <h3>Endere??o</h3>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <h6>IPTU</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['iptu']?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>CEP</h6>
                                <p class="text-dark mt-1"><?=Helpers::mask($dadosEmpresa[0]['cep'], '#####-###')?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Logradouro</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['logradouro']?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>N??mero</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['numero']?></p>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <h6>Bairro</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['bairro']?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Cidade</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['cidade']?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>UF</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['endereco_uf']?></p>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-4">
                                <h6>Complemento</h6>
                                <p class="text-dark mt-1"><?=$dadosEmpresa[0]['complemento']?></p>
                            </div>
                        </div>
                        <hr>
                        
                        <!-- ********** ACESSOS ********** -->

                        <div class="row">
                            <div class="col text-center">
                                <h3>Acessos</h3>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <?php foreach ($acessos as $arraychaves => $arrayDados) : ?>
                                <div class="col-4">
                                    <h6>Site</h6>
                                    <a href="<?=$arrayDados['site']?>" class="" target="_blank"><?=$arrayDados['site']?></a>
                                </div>
                                <div class="col-4">
                                    <h6>Login</h6>
                                    <h5><?=$arrayDados['login']?></h5>
                                </div>
                                <div class="col-4">
                                    <h6>Senha</h6>
                                    <h5><?=$arrayDados['senha']?></h5>
                                </div>
                            <?php endforeach ?>                        
                        </div>
                        <hr>

                        <!-- ********** PLANOS ********** -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <h3>Planos</h3>
                            </div>
                        </div>
                        <?php foreach ($planos as $arraychaves => $arrayDados) : ?>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <h6>Plano</h6>
                                    <h5><?=$arrayDados['nome']?></h5>
                                </div>

                                <div class="col-4">
                                    <h6>Valor</h6>
                                    <h5>R$ <?=Helpers::formataMoedaView($arrayDados['valor'])?></h5>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <hr>                        

                        <!-- ********** SOCIOS ********** -->
                        
                        <div class="row my-4">
                            <div class="col text-center">
                                <h3>Socios</h3>
                            </div>
                        </div>
                        <?php foreach ($dadosEmpresa as $arraychaves => $arrayDados) : ?>
                            <div class="row mb-2 mt-4">
                                <div class="col-md-3">
                                    <h6>Nome <?=(sizeof($dadosEmpresa) == 1) ? '' : $arraychaves+1?></h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['nome_completo']?></p>
                                </div>
                                <div class="col-md-3">
                                    <h6>CPF</h6>
                                    <p class="text-dark mt-1"><?=Helpers::mask($arrayDados['cpf'], '###.###.###-##')?></p>
                                </div>
                                <div class="col-md-3">
                                    <h6>Email</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['email']?></p>
                                </div>
                                <div class="col-md-3">
                                    <h6>Telefone Celular</h6>
                                    <p class="text-dark mt-1"><?=Helpers::mask($arrayDados['telefone_celular'],'(##) #####-####')?></p>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <h6>Estado Civil</h6>
                                    <p class="text-dark mt-1"><?=EstadoCivil::formataEstadoCivil($arrayDados['estado_civil'])?></p>
                                </div>
                                <div class="col-md-3">
                                    <h6>Regime de Casamento</h6>
                                    <p class="text-dark mt-1"><?=EstadoCivil::formataRegimeCasamento($arrayDados['regime_casamento'])?></p>
                                </div>                             
                                <div class="col-md-3">
                                    <h6>Data de Nascimento</h6>
                                    <p class="text-dark mt-1"><?=Helpers::formataDataView($arrayDados['data_nascimento'])?></p>
                                </div>                                
                                <div class="col-md-3">
                                    <h6>Telefone Comercial</h6>
                                    <p class="text-dark mt-1">
                                        <?php
                                            ($arrayDados['telefone_comercial'] == '')? '' : Helpers::mask($arrayDados['telefone_comercial'], '(##) ####-####');
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <h6>Profiss??o</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['profissao']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>CRM</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['crm']?></p>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <h6>Porcentagem Societ??ria</h6>
                                    <p class="text-dark mt-1"><?=number_format($arrayDados['porcentagem_societaria'],0)?>%</p>
                                </div>                                
                            </div>
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <h6>Documento Cadastrado</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['tipo_documento']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>N??mero do Documento</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['doc_numero']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Data de Emiss??o</h6>
                                    <p class="text-dark mt-1"><?=Helpers::formataDataView($arrayDados['data_emissao'])?></p>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <h6>??rg??o Expedidor</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['orgao_expedidor']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Validade</h6>
                                    <p class="text-dark mt-1"><?=Helpers::formataDataView($arrayDados['validade'])?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>UF</h6>
                                    <p class="text-dark mt-1"><?=($arrayDados['doc_uf'] == 0)? '' : $arrayDados['doc_uf']?></p>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <h6>Naturalidade</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['naturalidade']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>IES</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['ies_nome']?></p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Cidade IES</h6>
                                    <p class="text-dark mt-1"><?=$arrayDados['ies_cidade']?></p>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/empresa/ativacao/inativa.php'; ?>

<div class="modal fade" id="cadastra-acesso" tabindex="-1" role="dialog" aria-labelledby="cadastra-acesso" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text text-secondary">Cadastro de Acessos.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="text text-secondary mb-4">Aqui voc?? cadastra o login e senha de acesso da Empresa no(s) site(s) da(s) Prefeitura(s).</h6>

                <div class="text-right mt-2">
                    <form action="../controllers/empresa/insere-acesso.php" method="post" class="needs-validation" novalidate autocomplete="off">
                        <input value="<?= $_SESSION['viewIdEmpresa'] ?>" name="empresas_id" hidden>

                        <div class="row mb-4 text-center">
                            <div class="col-md-4">
                                <label for="site" class="label-cadastro">Site</label>
                                <input name="site" type="text" class="form-control text-center" id="site" required autocomplete="off">
                                <div class="invalid-feedback">
                                    Digite um endere??o de Site v??lido.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="login" class="label-cadastro">Login</label>
                                <input name="login" type="text" class="form-control text-center" id="login" maxlength="50" required autocomplete="off">
                                <div class="invalid-feedback">
                                    Digite um Login v??lido.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="senha" class="label-cadastro">Senha</label>
                                <input name="senha" type="text" class="form-control text-center" id="senha" maxlength="50" required autocomplete="off">
                                <div class="invalid-feedback">
                                    Digite uma Senha v??lida.
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-cadastrar" type="submit">Cadastrar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script src="../assets/custom-js/loading-automatico.js" charset="utf-8"></script>

<script type="text/javascript">
    $('#data-competencia').mask('00/0000');
</script>
