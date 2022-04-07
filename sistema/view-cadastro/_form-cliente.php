<?php
use App\DAO\IesDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro Cliente");
require_once('menu-left.php');
require_once('../cabecalho.php');

require_once('../../banco/conecta-medb.php');
?>

<?php
    $iesDAO = new IesDAO($conexao);
    $ies_array = $iesDAO->getTodasIes();
?>

<div class="container-fluid">
    <div class="text-center mb-5">
        <?php if(array_key_exists('resultado_insercao_cliente', $_COOKIE) && $_COOKIE['resultado_insercao_cliente'] == "false"){ ?>
            <div class="text-center alert alert-danger alert-dismissible fade show alert-login" role="alert">
                <strong><?=$_COOKIE['mensagem_insercao'];?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } elseif(array_key_exists('resultado_insercao_cliente', $_COOKIE) && $_COOKIE['resultado_insercao_cliente'] == "true") { ?>
            <div class="text-center alert alert-primary alert-dismissible fade show alert-login" role="alert">
                <strong><?=$_COOKIE['mensagem_insercao'];?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
    </div>

    <form class="needs-validation" action="cliente/insere-cliente.php" method="post" autocomplete="off" novalidate>
        <input name="usuarios_id" value="<?=$_SESSION['id_usuario']?>" hidden>

        <div class="row">
            <div class="col-md-6 mb-3 label-cadastro">
                <label for="cpf">CPF *</label>
                <input id="cpf" class="form-control col-6" type="text" name="cpf" required>
                <div class="invalid-feedback">
                    Digite um CPF válido.
                </div>
            </div>

            <div class="col-md-6 mb-3 label-cadastro">
                <label for="cpf">Situação do CPF</label>
                <div id='situacao'>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3 label-cadastro">
                <label for="nome">Nome Completo *</label>
                <input id="nome" class="form-control" type="text" name="nome" required autocomplete="none">
                <div class="invalid-feedback">
                    Digite um nome válido.
                </div>
            </div>

            <div class="col-md-6 mb-3 label-cadastro">
                <label for="nome">Nome da Mãe</label>
                <input id="nome-mae" class="form-control" type="text" name="nome_mae" autocomplete="none">
                <div class="invalid-feedback">
                    Digite um nome válido.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mb-3 label-cadastro">
                <label for="sexo">Sexo *</label>
                <select name="sexo" class="custom-select d-block w-100 col-md-6" id="sexo" required>
                    <option value="">Escolha...</option>
                    <option id="M" value="M">Masculino</option>
                    <option id="F" value="F">Feminino</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-md-6 mb-3 label-cadastro">
                <label for="nascimento">Data de nascimento *</label>
                <input name="data_nascimento" type="date" class="form-control col-6" id="nascimento" placeholder="" min="1930-01-01" required>
                <div class="invalid-feedback">
                    Digite uma data de nascimento válida.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3 label-cadastro">
                <label for="email">Email</label>
                <input name="email" type="text" class="form-control col-6" id="email" placeholder="exemplo@exemplo.com" maxlength="50" autocomplete="none">
            </div>

            <div class="col-md-6 mb-3 label-cadastro" type="text">
                <label for="faculdade">IES</label>
                <select name="ies_id" class="col-6 custom-select d-block w-100" id="faculdade">
                    <option value="">Escolha...</option>
                    <?php foreach ($ies_array as $ies) : ?>
                        <option value="<?=$ies['id']?>"><?=$ies['nome'].' - '.$ies['cidade']?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3 label-cadastro">
                <label for="telefone-celular">Telefone Celular *</label>
                <input name="telefone_celular" type="text" class="col-md-6 form-control" id="telefone-celular" autocomplete="none" placeholder="" required>
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

        <div class="row">
            <div class="col-6 mb-3 label-cadastro">
                <label for="profissao">Profissão *</label>
                <select name="profissao" class="custom-select d-block w-100 col-md-6" id="profissao" required>
                    <option value="">Escolha...</option>
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
            <div class="col-md-6 mb-3 label-cadastro">
                <label for="crm">CRM </label>
                <input name="crm" type="text" class="form-control col-6" id="crm" maxlength="20">
            </div>

            <div class="col-md-6 form-check">
    			<label for="socio-administrador" class="label-cadastro d-block">Sócio Administrador?</label>
    			<div class="col-md-2 d-block div-check label-cadastro">
					<input name="is_socio_admnistrador" class="form-check-input" type="checkbox" id="socio-administrador">
					<span>Sim</span>
    			</div>
    		</div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <hr>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6 mb-3 label-cadastro">
                <label for="tipo-documento">Tipo de Documento *</label>
                <select name="tipo_documento" class="custom-select d-block w-100 col-md-6" id="tipo-documento" required>
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
            <div class="col-6 mb-3 label-cadastro">
                <label for="data-emissao">Data Emissão *</label>
                <input name="data_emissao" type="date" class="form-control col-6" id="data-emissao" required autocomplete="none">
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-md-6 mb-3 label-cadastro">
                <label for="numero-documento">Número *</label>
                <input name="numero_documento" type="text" class="form-control col-6" id="numero-documento" maxlength="50" required autocomplete="none">
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6 mb-3 label-cadastro">
                <label for="documento-validade">Validade</label>
                <input name="documento_validade" type="date" class="form-control col-6" id="documento-validade" autocomplete="none">
            </div>

            <div class="col-md-3 label-cadastro" type="text">
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
            <div class="col-6 mb-3 label-cadastro">
                <label for="documento-orgao">Órgão Expedidor *</label>
                <input name="documento_orgao" type="text" class="form-control col-6" id="documento-orgao" autocomplete="none" maxlength="70" required>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>

            <div class="col-6 mb-3 label-cadastro">
                <label for="documento-naturalidade">Nacionalidade *</label>
                <input value="Brasileiro" name="documento_naturalidade" type="text" class="form-control col-6" id="documento-naturalidade" autocomplete="none" maxlength="50" required>
                <div class="invalid-feedback">
                    Obrigatório *
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <hr>
            </div>
        </div>

    	<div class="row mb-3">
            <div class="col-md-6">
                <label for="iptu" class="label-cadastro">IPTU *</label>
                <input name="iptu" type="text" class="form-control col-md-6" id="iptu" maxlength="30" required>
                <div class="invalid-feedback">
                    Digite um número válido.
                </div>
            </div>

    		<div class="col-md-6 form-check">
    			<label for="check-endereco-empresa" class="label-cadastro d-block">É o mesmo endereço da empresa?</label>
    			<div class="col-md-2 d-block div-check label-cadastro">
					<input name="is_endereco_empresa" class="form-check-input" type="checkbox" id="check-endereco-empresa">
					<span>Sim</span>
    			</div>
    		</div>
    	</div>

        <div id="div-numero-empresa" class="row mb-3" hidden>
            <div class="col-6 label-cadastro">
                <label for="numero-empresa">Número Empresa *</label>
                <input id="input-numero-empresa" name="numero_empresa" class="form-control col-3" type="text" autocomplete="nope">
            </div>
        </div>

		<div class="row mb-3">
			<div class="col-md-6">
				<label for="cep" class="label-cadastro">CEP *</label>
				<input name="cep" type="text" class="form-control col-md-6" id="cep" maxlength="15" autocomplete="none" required>
				<div class="invalid-feedback">
					Obrigatório *
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-6">
				<label for="logradouro" class="label-cadastro">Logradouro *</label>
				<input name="logradouro" type="text" class="form-control" id="logradouro" maxlength="50" autocomplete="none" required>
				<div class="invalid-feedback">
					Obrigatório *
				</div>
			</div>

			<div class="col-md-6">
				<label for="numero-endereco" class="label-cadastro">Número *</label>
				<input name="numero-endereco" type="text" class="form-control col-md-4" id="numero-endereco" maxlength="10" required>
					<div class="invalid-feedback">
						Obrigatório *
					</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-6">
				<label for="bairro" class="label-cadastro">Bairro *</label>
				<input name="bairro" type="text" class="form-control" id="bairro" maxlength="50" required>
				<div class="invalid-feedback">
	                Obrigatório *
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-6">
				<label for="cidade" class="label-cadastro">Cidade *</label>
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
			<div class="col-md-9">
				<label for="complemento" class="label-cadastro">Complemento<span class="text-muted">(Opicional)</span></label>
				<input name="complemento" type="text" class="form-control" id="complemento" maxlength="50">
			</div>
		</div>

        <div class="row mb-3">
            <div class="col-12">
                <hr>
            </div>
        </div>

        <div class="text-center mb-5 mt-4">
            <button class="btn btn-cadastrar" type="submit">Cadastrar</button>
        </div>
    </form>
</div>

<?php
require_once('rodape.php');

require_once('../rodape.php');
?>

<script type="text/javascript">
    var cpf = document.getElementById("cpf");
    cpf.addEventListener("keyup", function(){
        if(cpf.value.length == 14){
            $("#cpf").blur();
            carregaDadosCpf();
        }
    });

    function carregaDadosCpf(){
        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "../../web-api/consulta-cpf.php", true);
        xhttp.setRequestHeader("Content-type", "application/json");

        var cpfObjeto = {};

        cpfObjeto['cpf'] = cpf.value;

        var jsonParaEnviar = JSON.stringify(cpfObjeto);

        xhttp.send(jsonParaEnviar);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                populaDadosCpf(this.responseText);
            }
        };
    }

    function populaDadosCpf(jsonDadosCpf){
        var dadosCpfObjeto = JSON.parse(jsonDadosCpf);
        console.log(dadosCpfObjeto);

        var nome =  document.getElementById('nome');
        nome.setAttribute("value", dadosCpfObjeto['nome']);

        var nomeMae =  document.getElementById('nome-mae');
        nomeMae.setAttribute("value", dadosCpfObjeto['mae']);

        var nascimento =  document.getElementById('nascimento');
        nascimento.setAttribute("value",dateToEN(dadosCpfObjeto['nascimento']));

        var sexo =  document.getElementById(dadosCpfObjeto['genero']);
        sexo.selected = "true";

        var situacao =  document.getElementById('situacao');
        situacao.innerHTML = dadosCpfObjeto['situacao'];
        var inputSituacao = document.createElement("INPUT");
        inputSituacao.setAttribute("name", "situacao_cadastral");
        inputSituacao.setAttribute("hidden", "true");
        inputSituacao.setAttribute("value", dadosCpfObjeto['situacao']);
        situacao.appendChild(inputSituacao);
    }

    function dateToEN(date){
    	return date.split('/').reverse().join('-');
    }
</script>

<script type="text/javascript">
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
</script>

<script type="text/javascript">
    var selectProfissao = document.getElementById("profissao");
    var divOutraProfissao = document.getElementById("div-outra-profissao");

    selectProfissao.addEventListener("change", function(){
        if(document.getElementById("outra").selected){
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
        }else{
            document.getElementById('input-outra-profissao').remove();
            document.getElementById('label-profissao').remove();
        }
    });

    var checkEndereco = document.getElementById('check-endereco-empresa');
    checkEndereco.addEventListener('change', function(){
        if(checkEndereco.checked){
            document.getElementById("div-numero-empresa").removeAttribute("hidden");
            document.getElementById("input-numero-empresa").setAttribute("required", "true");
        }else{
            document.getElementById("div-numero-empresa").setAttribute("hidden","true");
            document.getElementById("input-numero-empresa").value = null;
            document.getElementById("input-numero-empresa").removeAttribute("required");
        }
    });

    var documentoOrgao = document.getElementById("documento-orgao");
    documentoOrgao.addEventListener("keyup", function(){
        documentoOrgao.value = documentoOrgao.value.toUpperCase();
    });
</script>

<script type="text/javascript">
    $('#dia-vencimento').mask('00');
    $("#cpf").mask("000.000.000-00", {reverse: true});
    $("#cep").mask("00000-000");
    $("#telefone-celular").mask("(00) 00000-0000");
    $("#telefone-comercial").mask("(00) 0000-0000");
</script>
