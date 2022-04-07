<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Envio de Proposta Comercial");
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new \App\DAO\ProspectDAO();
$prospect = $dao->getProspectProposta($_GET['prospect']);
$propostas = $dao->getProspectEmails($_GET['prospect']);

$usuariosId = $_SESSION['id_usuario'];

$quantidadeEmpresas = 1;
?>

<div class="container-fluid">    
    <?php \App\Helper\Mensagem::getMensagem($_COOKIE, 'envioPropostaComercial', 'mensagemPropostaComercial'); ?>

    <div class="card">
        <div class="card-header bg-cor-accent-primaria text-center">
            <i class="fas fa-building h4"></i><strong class="card-title pl-md-2 h4">Envio de Proposta Comercial</strong>
        </div>
        <div class="card-body">
            <form class="needs-validation-loading" method="POST" action="../controllers/proposta/envia.php" novalidate>
                <input name="usuariosId" value="<?=$usuariosId?>" hidden>
                <input name="prospect" value="<?=$_GET['prospect']?>" hidden>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="label-cadastro">Email *</label>
                        <input value="<?=$prospect['email']?>" readonly name="email" type="text" class="form-control" required autocomplete="off">
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="label-cadastro">Nome Empresa *</label>
                        <input value="<?=$prospect['nome_empresa']?>" name="empresas[<?=$quantidadeEmpresas?>][nome]" type="text" class="form-control" required autocomplete="off">
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-4">
                        <label class="label-cadastro">Faturamento Mês</label>               
                        <select class="form-control" name="empresas[<?=$quantidadeEmpresas?>][faturamento]">
                            <option value="">Escolha...</option>
                            <option value="1">até R$40.000/mês</option>
                            <option value="2">de R$40.001 até R$80.000/mês</option>
                            <option value="3">de R$80.001 até R$120.000/mês</option>
                            <option value="4">de R$120.001 até R$160.000/mês</option>
                            <option value="5">de R$160.001 até R$200.000/mês</option>
                            <option value="6">de R$200.001 até R$240.000/mês</option>
                            <option value="7">de R$280.001 até R$320.000/mês</option>
                            <option value="8">de R$360.001 até R$400.000/mês</option>
                            <option value="9">de R$440.001 até R$480.000/mês</option>
                            <option value="10">de R$480.001 até R$520.000/mês</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="label-cadastro">Honorário atual</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend2">R$</span>
                            </div>
                            <input id="honorario" name="empresas[<?=$quantidadeEmpresas?>][honorario]" type="text" class="form-control" autocomplete="off">
                            <div class="invalid-feedback">
                                Obrigatório *
                            </div>
                        </div>                
                    </div>
                    <div class="col-md-4">
                        <label class="label-cadastro">Paga 13º de Honorário? *</label>
                        <select class="custom-select" name="empresas[<?=$quantidadeEmpresas?>][decimoTerceiro]" required>
                            <option value="">Escolha...</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                        </select>               
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col text-center">
                        <h5 class="label-cadastro">Financeiro</h5>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-md-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="label-cadastro border-top-0" scope="col">Qtd</th>
                                    <th class="label-cadastro border-top-0" scope="col"></th>
                                    <th class="label-cadastro border-top-0" scope="col">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input class="form-control text-center" type="number">
                                    </td>
                                    <td class="label-cadastro">Sócios</td>
                                    <td class="font-weight-bold">R$100,00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control text-center" type="number">
                                    </td>
                                    <td class="label-cadastro">Funcionários</td>
                                    <td class="font-weight-bold">R$100,00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control text-center" type="number">
                                    </td>
                                    <td class="label-cadastro">Domésticas</td>
                                    <td class="font-weight-bold">R$100,00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-info btn-padrao font-weight-bold">
                                                <input type="radio" name="options" id="option1" autocomplete="off"> Sim
                                            </label>
                                            <label class="btn btn-info btn-padrao font-weight-bold">
                                                <input type="radio" name="options" id="option2" autocomplete="off"> Não
                                            </label>                             
                                        </div>
                                    </td>
                                    <td class="label-cadastro">Gestor&nbsp;Administrativo?</td>
                                    <td class="font-weight-bold">R$100,00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="custom-select" name="" required>
                                            <option value="">Escolha...</option>
                                            <option value="contabilidade1">1</option>
                                            <option value="contabilidade2">2</option>
                                            <option value="contabilidade3">3</option>
                                        </select> 
                                    </td>
                                    <td class="label-cadastro">Contabilidade?</td>
                                    <td class="font-weight-bold">R$100,00</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="label-cadastro">Total</td>
                                    <td class="font-weight-bold">R$500,00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="empresasAdicionais"></div>
                <div class="text-center my-3">
                    <button class="btn btn-padrao btn-success font-weight-bold">Enviar proposta</button>
                </div>
            </form>
        </div>
    </div>    

    <?php if (! empty($propostas)) : ?>
        <div class="table-responsive mb-5">
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">
                    <tr class="table-success">
                        <th class="text-center" scope="col" colspan="4">Emails Enviados</th>
                    </tr>                   
                    <tr class="table-success">
                        <th scope="col">Aos cuidados</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Hora Envio</th>
                        <th scope="col">Link</th>
                    </tr>
                </thead>
                <tbody class="label-cadastro">
                    <?php foreach ($propostas as $proposta) :?>
                        <tr>
                            <td><?=$proposta['aos_cuidados']?></td>
                            <td><?=$proposta['empresa_nome']?></td>
                            <td><?=Helpers::formataDataCompletaView($proposta['enviadoAs'])?></td>
                            <td>
                                <a class="text-info" target="_blank"
                                href="http://sistema.grupobcontabil.com.br/sistema/views/whatsapp/proposta-comercial-medcontabil.php?proposal=<?=$proposta['proposal']?>">
                                        Proposta
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script>
    $('#honorario').mask('0.000,00', {reverse: true});
</script>