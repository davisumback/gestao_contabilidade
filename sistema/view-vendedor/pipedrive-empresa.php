<?php
use App\DAO\ClienteDAO;
use App\DAO\PlanoDAO;
use App\DAO\IesDAO;
use App\Helper\Helpers;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro Cliente ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$clienteId = $_GET['clienteId'];
$vendedorId = $_SESSION['id_usuario'];

$dao = new ClienteDAO();
$cliente = $dao->getClienteAConfirmarPipedrive($clienteId, $vendedorId);

$iesDao = new IesDAO();
$iesArray = $iesDao->getTodasIes();

$planoDAO = new PlanoDAO();
$planos = $planoDAO->getTodosPlanos();
?>

<div class="container-fluid">
    <div class="text-center mb-3">
        <div class="alert alert-success" role="alert">
            <h6>Aqui você confirma o cadastro do cliente vindo do <strong>Pipedrive</strong></h6>
        </div>
    </div>

    <?=Mensagem::getMensagem($_COOKIE, 'insercaoClienteOutroEscritorio', 'mensagemClienteOutroEscritorio');?>

    <form enctype="multipart/form-data" class="needs-validation-loading" action="../controllers/pre-empresa/insere-empresa-constituida.php" method="post" autocomplete="off" novalidate>
        <input name="vendedorId" value="<?=$vendedorId?>" hidden>
        <input name="pre_empresa_id" value="<?=$cliente['pre_empresa_id']?>" hidden>
        <input name="id_cliente" value="<?=$clienteId?>" hidden>
        <input name="sexo" value="<?=$cliente['sexo']?>" hidden>
        <input name="situacao_cadastral" value="<?=$cliente['situacao_cadastral']?>" hidden>

        <div class="row text-center">
            <div class="col-md-6 col-sm-12 mb-3 mx-auto label-cadastro">
                <label for="cnpj">CNPJ *</label>
                <input id="cnpj" class="text-center form-control mx-auto col-md-6 col-sm-12" type="text" name="cnpj" required>
                <div class="invalid-feedback">
                    Digite um CNPJ válido.
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 mb-3 label-cadastro">
                <label for="nome">Nome *</label>
                <input value="<?=$cliente['nome_completo']?>" name="nome" type="text" class="form-control" id="nome" autocomplete="none" required>
                <div class="invalid-feedback">
                    Digite um número de telefone válido.
                </div>
            </div>

            <div class="col-md-6 mb-3 label-cadastro">
                <label for="nome">Nome da Mãe</label>
                <input value="<?=$cliente['nome_mae']?>" id="nome-mae" class="form-control" type="text" name="nome_mae" autocomplete="none">
                <div class="invalid-feedback">
                    Digite um nome válido.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="cpf">CPF *</label>
                <input value="<?=$cliente['cpf']?>" id="cpf" class="form-control col-md-6 col-sm-12" type="text" name="cpf" required>
                <div class="invalid-feedback">
                    Digite um CPF válido.
                </div>
            </div>

            <div class="col-md-6 mb-3 label-cadastro">
                <label for="cpf">Situação do CPF</label>
                <h5><?=$cliente['situacao_cadastral']?></h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="nascimento">Data de nascimento *</label>
                <input value="<?=$cliente['data_nascimento']?>" name="data_nascimento" type="date" class="form-control col-md-6 col-sm-12" id="nascimento" placeholder="" min="1930-01-01" required>
                <div class="invalid-feedback">
                    Digite uma data de nascimento válida.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="email">Email *</label>
                <input value="<?=$cliente['email']?>" name="email" type="text" class="form-control col-md-6 col-sm-12" id="email" maxlength="50" autocomplete="none" required>
                <div class="invalid-feedback">
                    Obrigatório
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-3 label-cadastro" type="text">
                <label for="faculdade">IES</label>
                <select name="ies_id" class="col-md-6 col-sm-12 custom-select d-block w-100" id="faculdade">
                    <option value="">Escolha...</option>
                    <?php foreach ($iesArray as $ies) : ?>
                        <option value="<?=$ies['id']?>"><?=$ies['nome'].' - '.$ies['cidade']?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="telefone-celular">Telefone Celular *</label>
                <input value="<?=$cliente['telefone_celular']?>" name="telefone_celular" type="text" class="col-md-6 col-sm-12 form-control" id="telefone-celular" autocomplete="none" placeholder="" required>
                <div class="invalid-feedback">
                    Digite um número de telefone válido.
                </div>
            </div>

            <div class="col-md-6 mb-3 label-cadastro">
                <label for="telefone-comercial">Telefone Comercial</label>
                <input name="telefone_comercial" type="text" class="form-control col-md-6" id="telefone-comercial" autocomplete="none">
                <div class="invalid-feedback">
                    Digite um número válido.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mb-3 label-cadastro">
                <label>Sócio Administrador *</label>
                <select name="is_socio_administrador" class="custom-select d-block w-100 col-md-6" required>
                    <option value="">Escolha...</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-6 mb-3 label-cadastro">
                <label>Porcentagem Sócietária *</label>
                <input type="text" name="porcentagem_societaria" class="col-md-6 col-sm-12 form-control" required>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="profissao">Profissão *</label>
                <select name="profissao" class="custom-select d-block w-100 col-md-6 col-sm-12" id="profissao" required>
                    <option value="Médico">Médico</option>
                    <option id="outra" value="Outra">Outra</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-6 mb-3 label-cadastro" id="div-outra-profissao">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="crm">CRM </label>
                <input value="<?=$cliente['crm']?>" name="crm" type="text" class="form-control col-md-6 col-sm-12" id="crm" maxlength="20">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="linha"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label>Primeira Mensalidade *</label>
                <input value="<?=$cliente['primeira_mensalidade']?>" name="primeira_mensalidade" type="date" class="col-md-6 col-sm-12 form-control" autocomplete="none" required>
                <div class="invalid-feedback">
                    Obrigatório
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="tipo-societario">Tipo Societário *</label>
                <select name="tipo_societario" class="custom-select d-block w-100 col-md-6 col-sm-12" id="tipo-societario" required>
                    <option value="">Escolha...</option>
                    <option value="Eireli">Eireli</option>
                    <option value="LTDA">LTDA</option>
                    <option value="Individual">Individual</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="plano">Plano *</label>
                <select name="planos[]" class="custom-select d-block w-100 col-md-6 col-sm-12" id="plano" required>
                    <option value="">Escolha...</option>
                    <?php foreach($planos as $plano) : ?>
                        <option id="plano_id-<?=$plano['id']?>" value="<?=$plano['id']?>"><?=$plano['nome']. ' - R$ ' .Helpers::formataMoedaView($plano['valor'])?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    Escolha um plano.
                </div>
            </div>

            <div class="col-md-6 label-cadastro">
                <label class="d-block">Incluir Plano</label>
                <i style="cursor:pointer;font-size:1.2em;" class="ml-2 fas fa-plus" onclick="incluirPlano()"></i>
            </div>
        </div>

        <div class="row">
            <div id="incluir-plano" class="col-12" style="padding-left:0!important;">

            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <hr>
            </div>
        </div>

        <div class="text-center mb-5 mt-4">
            <button class="btn btn-cadastrar" type="submit">Confirmar</button>
        </div>
    </form>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    window.onload = function() {
        $("#cnpj").focus();

        var ies = '<?=$cliente['ies_id']?>';
        var faculdade = document.getElementById('faculdade');
        faculdade.value = ies;

        var plano = document.getElementById('plano_id-<?=$cliente['id_plano']?>');
        plano.selected = true;
    };

    var divIncluirPlano = document.getElementById('incluir-plano');
    var quantidadePlano = 0;

    function incluirPlano(){
        quantidadePlano++;

        var divColuna = document.createElement("DIV");
        divColuna.className = 'col-md-6 mb-3 label-cadastro';

        var label = document.createElement("LABEL");
        label.innerHTML = 'Plano';
        divColuna.appendChild(label);

        var select = document.createElement("SELECT");
        select.setAttribute("name", "planos[]");
        select.className = 'custom-select d-block w-100 col-md-6 col-sm-12';
        var inputQuantidadePlano = document.createElement("INPUT");
        inputQuantidadePlano.setAttribute("name", "quantidade_plano");
        inputQuantidadePlano.setAttribute("value", quantidadePlano);
        inputQuantidadePlano.setAttribute("hidden", "true");
        divIncluirPlano.appendChild(inputQuantidadePlano);

        var option = document.createElement("OPTION");
        option.innerHTML = 'Escolha..';
        select.appendChild(option);

        <?php foreach($planos as $plano) : ?>
            var option = document.createElement("OPTION");
            option.setAttribute("value", "<?=$plano['id']?>");
            option.innerHTML = "<?=$plano['nome']. ' - R$ ' .Helpers::formataMoedaView($plano['valor'])?>";
            select.appendChild(option);
        <?php endforeach ?>

        divColuna.appendChild(select);
        divIncluirPlano.appendChild(divColuna);
    }

    var selectProfissao = document.getElementById("profissao");
    var divOutraProfissao = document.getElementById("div-outra-profissao");

    selectProfissao.addEventListener("change", function() {
        if (document.getElementById("outra").selected) {
            var label = document.createElement("LABEL");
            label.innerHTML = "Profissão *";
            label.setAttribute("id", 'label-profissao');
            label.setAttribute("for", "input-outra-profissao");
            divOutraProfissao.appendChild(label);

            var inputOutraProfissao = document.createElement("INPUT");
            inputOutraProfissao.className = 'form-control col-6';
            inputOutraProfissao.setAttribute("id", 'input-outra-profissao');
            inputOutraProfissao.setAttribute("maxlength", '100');
            inputOutraProfissao.setAttribute("required", 'true');
            inputOutraProfissao.setAttribute("autocomplete", 'none');
            inputOutraProfissao.setAttribute("type", 'text');
            inputOutraProfissao.setAttribute("name", 'outra_profissao');
            divOutraProfissao.appendChild(inputOutraProfissao);
        } else {
            document.getElementById('input-outra-profissao').remove();
            document.getElementById('label-profissao').remove();
        }
    });
</script>

<script type="text/javascript">
    $("#cpf").mask("000.000.000-00", {reverse: true});
    $("#cep").mask("00000-000");
    $("#telefone-celular").mask("(00) 00000-0000");
    $("#telefone-comercial").mask("(00) 0000-0000");
    $("#cnpj").mask("00.000.000/0000-00", {reverse: true});
</script>
