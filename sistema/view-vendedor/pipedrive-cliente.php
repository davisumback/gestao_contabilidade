<?php
use App\DAO\ClienteDAO;
use App\DAO\PlanoDAO;
use App\DAO\IesDAO;
use App\Helper\Helpers;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');

$clienteId = $_GET['clienteId'];
$vendedorId = $_SESSION['id_usuario'];

$dao = new ClienteDAO();
$cliente = $dao->getClienteAConfirmarPipedrive($clienteId, $vendedorId);

if ($cliente['empresa_outro_escritorio'] == 1) {
    header("Location: pipedrive-empresa.php?clienteId=" . $clienteId);
    die();
}

$menu_topo->setTituloNavegacao("Cadastro Cliente ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');

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

    <?=Mensagem::getMensagem($_COOKIE, 'confirmacaoCliente', 'mensagemConfirmacao');?>

    <form enctype="multipart/form-data" class="needs-validation-loading" action="../controllers/cliente/insere-cliente-pipedrive.php" method="post" autocomplete="off" novalidate>
        <input name="pre_empresa_id" value="<?=$cliente['pre_empresa_id']?>" hidden>
        <input name="id_cliente" value="<?=$cliente['id_cliente']?>" hidden>
        <input name="sexo" value="<?=$cliente['sexo']?>" hidden>
        <input name="situacao_cadastral" value="<?=$cliente['situacao_cadastral']?>" hidden>

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

        <div class="row">
            <div class="col-6 mb-3 label-cadastro">
                <label for="estado-civil">Estado Civil *</label>
                <select name="estado_civil" class="custom-select d-block w-100 col-md-6" id="estado-civil" required>
                    <option value="">Escolha...</option>
                    <option value="SO">Solteiro</option>
                    <option value="CA">Casado</option>
                    <option value="DI">Divorciado</option>
                    <option value="VI">Viúvo</option>
                    <option value="SE">Separado</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-6 mb-3 label-cadastro">
                <label for="regime-casamento">Regime Casamento</label>
                <select name="regime_casamento" class="custom-select d-block w-100 col-md-6" id="regime-casamento">
                    <option value="">Escolha...</option>
                    <option value="CP">Comunhão Parcial</option>
                    <option value="CU">Comunhão Universal</option>
                    <option value="PFA">Participação Final nos Aquestos</option>
                    <option value="SB">Separação de Bens</option>
                    <option value="SO">Seperação Obrigatória</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="linha"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-12 mb-3 label-cadastro">
                <label>Nome Empresa Opção 1</label>
                <input value="<?=$cliente['nome_1']?>" name="nome_1" type="text" class="col-sm-12 form-control" autocomplete="none" required>
                <div class="invalid-feedback">
                    Obrigatório
                </div>
            </div>

            <div class="col-md-4 col-sm-12 mb-3 label-cadastro">
                <label>Nome Empresa Opção 2</label>
                <input value="<?=$cliente['nome_2']?>" name="nome_2" type="text" class="col-sm-12 form-control" autocomplete="none" required>
                <div class="invalid-feedback">
                    Obrigatório
                </div>
            </div>

            <div class="col-md-4 col-sm-12 mb-3 label-cadastro">
                <label>Nome Empresa Opção 3</label>
                <input value="<?=$cliente['nome_3']?>" name="nome_3" type="text" class="col-sm-12 form-control" autocomplete="none" required>
                <div class="invalid-feedback">
                    Obrigatório
                </div>
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

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label>Número IPTU</label>
                <input name="numero_iptu" type="text" class="form-control col-md-6 col-sm-12" autocomplete="none">
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-md-6 col-sm-12 label-cadastro" id="div-upload-iptu">
                <label for="guia">IPTU</label>
                <input id="input-upload" class="form-control" type="file" name="iptu">
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-md-4 col-sm-12 label-cadastro" id="div-certidao-casamento" hidden>
                <label for="guia">Certidão Casamento *</label>
                <input id="certidao-casamento" class="form-control" type="file" name="certidao_casamento">
                <div class="invalid-feedback">
                    Escolha um documento
                </div>
            </div>

            <div class="col-md-4 col-sm-12 label-cadastro" id="div-certidao-averbada" hidden>
                <label for="guia">Certidão Casamento Averbada *</label>
                <input id="certidao-averbada" class="form-control" type="file" name="cartidao_casamento_averbada">
                <div class="invalid-feedback">
                    Escolha um documento
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-md-6 label-cadastro">
                <label for="guia">Upload Documento Pessoal *</label>
                <input id="input-upload" class="form-control" type="file" name="docPessoal" required>
                <div class="invalid-feedback">
                    Escolha um documento
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="tipo-documento">Tipo de Documento *</label>
                <select name="tipo_documento" class="custom-select d-block w-100 col-md-6 col-sm-12" id="tipo-documento" required>
                    <option value="">Escolha...</option>
                    <option value="RG">RG</option>
                    <option value="CNH">CNH</option>
                    <option value="RNE">RNE</option>
                    <option value="P">Passaporte</option>
                    <option value="CRM">CRM</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="data-emissao">Data Emissão *</label>
                <input name="data_emissao" type="date" class="form-control col-md-6 col-sm-12" id="data-emissao" required autocomplete="none">
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="numero-documento">Número *</label>
                <input name="numero_documento" type="text" class="form-control col-md-6 col-sm-12" id="numero-documento" maxlength="50" required autocomplete="none">
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="documento-validade">Validade</label>
                <input name="documento_validade" type="date" class="form-control col-md-6 col-sm-12" id="documento-validade" autocomplete="none">
            </div>

            <div class="col-md-3 col-sm-12 label-cadastro" type="text">
				<label for="documento-uf">UF</label>
				<select name="documento_uf" class="custom-select d-block w-100" id="documento-uf">
					<option value="" id="escolha">Escolha...</option>
					<option value="AC">Acre</option>
					<option value="AL">Alagoas</option>
					<option value="AP">Amapá</option>
					<option value="AM">Amazonas</option>
					<option value="BA">Bahia</option>
					<option value="CE">Ceará</option>
					<option value="DF">Distrito Federal</option>
					<option value="ES">Espírito Santo</option>
					<option value="GO">Goiás</option>
					<option value="MA">Maranhão</option>
					<option value="MT">Mato Grosso</option>
					<option value="MS">Mato Grosso do Sul</option>
					<option value="MG">Minas Gerais</option>
					<option value="PA">Pará</option>
					<option value="PB">Paraíba</option>
					<option value="PR">Paraná</option>
					<option value="PE">Pernambuco</option>
					<option value="PI">Piauí</option>
					<option value="RJ">Rio de Janeiro</option>
					<option value="RN">Rio Grande do Norte</option>
					<option value="RS">Rio Grande do Sul</option>
					<option value="RO">Rondônia</option>
					<option value="RR">Roraima</option>
					<option value="SC">Santa Catarina</option>
					<option value="SP">São Paulo</option>
					<option value="SE">Sergipe</option>
					<option value="TO">Tocantins</option>
				</select>
			</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="documento-orgao">Órgão Expedidor *</label>
                <input name="documento_orgao" type="text" class="form-control col-md-6 col-sm-12" id="documento-orgao" autocomplete="none" maxlength="70" required>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-3 label-cadastro">
                <label for="documento-naturalidade">Nacionalidade *</label>
                <input value="Brasileiro" name="documento_naturalidade" type="text" class="form-control col-md-6 col-sm-12" id="documento-naturalidade" autocomplete="none" maxlength="50" required>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="linha">
                </div>
            </div>
        </div>

		<div class="row mb-3">
			<div class="col-md-6 label-cadastro">
				<label for="cep">CEP *</label>
				<input name="cep" type="text" class="form-control col-md-6" id="cep" maxlength="15" autocomplete="none" required>
				<div class="invalid-feedback">
					Obrigatório *
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-6 label-cadastro">
				<label for="logradouro">Logradouro *</label>
				<input name="logradouro" type="text" class="form-control" id="logradouro" maxlength="50" autocomplete="none" required>
				<div class="invalid-feedback">
					Obrigatório *
				</div>
			</div>

			<div class="col-md-6 label-cadastro">
				<label for="numero-endereco">Número *</label>
				<input name="numero_endereco" type="text" class="form-control col-md-4" id="numero-endereco" maxlength="10" required>
					<div class="invalid-feedback">
						Obrigatório *
					</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-6 label-cadastro">
				<label for="bairro">Bairro *</label>
				<input name="bairro" type="text" class="form-control" id="bairro" maxlength="50" required>
				<div class="invalid-feedback">
	                Obrigatório *
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-6 label-cadastro">
				<label for="cidade">Cidade *</label>
				<input name="cidade" type="text" class="form-control" id="cidade" maxlength="50" autocomplete="none" required>
				<div class="invalid-feedback">
					Obrigatório *
				</div>
			</div>

			<div class="col-md-3 label-cadastro" type="text" required>
				<label for="estado">UF *</label>
				<select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
					<option value="" id="escolha">Escolha...</option>
					<option value="AC" id="AC">Acre</option>
					<option value="AL" id="AL">Alagoas</option>
					<option value="AP" id="AP">Amapá</option>
					<option value="AM" id="AM">Amazonas</option>
					<option value="BA" id="BA">Bahia</option>
					<option value="CE" id="CE">Ceará</option>
					<option value="DF" id="DF">Distrito Federal</option>
					<option value="ES" id="ES">Espírito Santo</option>
					<option value="GO" id="GO">Goiás</option>
					<option value="MA" id="MA">Maranhão</option>
					<option value="MT" id="MT">Mato Grosso</option>
					<option value="MS" id="MS">Mato Grosso do Sul</option>
					<option value="MG" id="MG">Minas Gerais</option>
					<option value="PA" id="PA">Pará</option>
					<option value="PB" id="PB">Paraíba</option>
					<option value="PR" id="PR">Paraná</option>
					<option value="PE" id="PE">Pernambuco</option>
					<option value="PI" id="PI">Piauí</option>
					<option value="RJ" id="RJ">Rio de Janeiro</option>
					<option value="RN" id="RN">Rio Grande do Norte</option>
					<option value="RS" id="RS">Rio Grande do Sul</option>
					<option value="RO" id="RO">Rondônia</option>
					<option value="RR" id="RR">Roraima</option>
					<option value="SC" id="SC">Santa Catarina</option>
					<option value="SP" id="SP">São Paulo</option>
					<option value="SE" id="SE">Sergipe</option>
					<option value="TO" id="TO">Tocantins</option>
				</select>
				<div class="invalid-feedback">
					Obrigatório *
				</div>
			</div>
		</div>

        <div class="row mb-3">
            <div class="col-md-9 label-cadastro">
                <label for="complemento">Complemento<span class="text-muted">(Opicional)</span></label>
                <input name="complemento" type="text" class="form-control" id="complemento" maxlength="50">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 label-cadastro">
                <label>Comprovante de Residência *</label>
                <input class="form-control" type="file" name="comprovante_residencia" required>
            </div>
            <div class="invalid-feedback">
                Escolha um documento
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
        var ies = '<?=$cliente['ies_id']?>';
        var faculdade = document.getElementById('faculdade');
        faculdade.value = ies;

        var plano = document.getElementById('plano_id-<?=$cliente['id_plano']?>');
        plano.selected = true;

        var divCertidaoCasamento = document.getElementById('div-certidao-casamento');
        var divCertidaoAverbada = document.getElementById('div-certidao-averbada');
        var certidaoCasamento = document.getElementById('certidao-casamento');
        var certidaoAverbada = document.getElementById('certidao-averbada');

        var estadoCivil = document.getElementById('estado-civil');
        estadoCivil.addEventListener("change", function(){
            if (estadoCivil.value == 'SO') {
                divCertidaoCasamento.setAttribute('hidden', 'true');
                divCertidaoAverbada.setAttribute('hidden', 'true');
                certidaoCasamento.removeAttribute('required');
                certidaoAverbada.removeAttribute('required');
            } else if(estadoCivil.value == 'DI' || estadoCivil.value == 'SE') {
                divCertidaoCasamento.setAttribute('hidden', 'true');
                divCertidaoAverbada.removeAttribute('hidden');
                certidaoCasamento.removeAttribute('required');
                certidaoAverbada.setAttribute('required', 'true');
            } else if(estadoCivil.value == 'CA') {
                divCertidaoAverbada.setAttribute('hidden', 'true');
                divCertidaoCasamento.removeAttribute('hidden');
                certidaoCasamento.setAttribute('required', 'true');
                certidaoAverbada.removeAttribute('required');
            }else {
                divCertidaoCasamento.setAttribute('hidden', 'true');
                divCertidaoAverbada.removeAttribute('hidden');
                certidaoCasamento.removeAttribute('required');
                certidaoAverbada.setAttribute('required', 'true');
            }
        });
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

    var cep = document.getElementById("cep");
    cep.addEventListener("keyup", function(){
        if(cep.value.length == 9){
            $("#cep").blur();
            carregaEndereco();
        }
    });

    function carregaEndereco(){
        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "../../web-api/consulta-endereco.php", true);
        xhttp.setRequestHeader("Content-type", "application/json");

        var entrada = document.getElementById("cep");
        var cepObjeto = {};

        cepObjeto['cep'] = entrada.value;

        var jsonParaEnviar = JSON.stringify(cepObjeto);

        xhttp.send(jsonParaEnviar);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                populaEndereco(this.responseText);
            }
        };
    }

    function populaEndereco(jsonEndereco){
        var enderecoObjeto = JSON.parse(jsonEndereco);

        var logradouro =  document.getElementById('logradouro');
        logradouro.setAttribute("value", enderecoObjeto['logradouro']);

        var cidade =  document.getElementById('cidade');
        cidade.setAttribute("value", enderecoObjeto['localidade']);

        var bairro =  document.getElementById('bairro');
        bairro.setAttribute("value", enderecoObjeto['bairro']);

        var complemento =  document.getElementById('complemento');
        complemento.setAttribute("value", enderecoObjeto['complemento']);

        var estado =  document.getElementById(enderecoObjeto['uf']);
        estado.selected = "true";
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
</script>
