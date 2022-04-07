<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;
use App\Helper\NaturezaJuridica;
use App\DAO\ClienteEmpresaDAO;
use App\DAO\EnderecoEmpresaDAO;
use App\DAO\PlanoDAO;
use App\DAO\UsuarioDAO;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro Empresa");
require_once('menu-left.php');
require_once('../cabecalho.php');

$dadosEmpresa = $_SESSION['api_dados_empresa'];
$dadosEmpresa = json_decode($dadosEmpresa, true);
$socioAdministrador = $dadosEmpresa['responsavel'];
$pasta = 'view-cadastro';

$planoDAO = new PlanoDAO();
$planoArray = $planoDAO->getTodosPlanos();
$usuarioDAO = new UsuarioDAO();
$gestores = $usuarioDAO->getPerfilUsuario(6);
$contadores = $usuarioDAO->getPerfilUsuario(4);
?>

<div class="container-fluid pb-2">
    <div class="text-center mb-3">
        <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao_empresa', 'mensagem_insercao');?>
    </div>
</div>
<div class="container-fluid">
    <div class="content " id="conteudo">
        <div class="row justify-content-around">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header bg-cor-accent-primaria">
                        <i class="fas fa-building h4"></i><strong class="card-title pl-md-2 h4">Cadastrar Empresa</strong>
                    </div>
                    <div class="card-body">
                        <form id="form" class="needs-validation-loading" action="../controllers/empresa/insere-empresa-migrada-2.php" method="post" autocomplete="off" novalidate>
                            <input name="usuarios_id" value="<?=$_SESSION['id_usuario']?>" hidden>
                            <input name="pasta" value="<?=$pasta?>" hidden>
                            <div class="row mb-3">
                                <div class="col-md-2 label-cadastro">
                                    <label for="cnpj">CNPJ *</label>
                                    <input id="cnpj" value="<?=$dadosEmpresa['cnpj']?>" class="form-control" type="text" name="cnpj" required autocomplete="off">
                                    <div class="invalid-feedback">
                                        Digite um CNPJ válido.
                                    </div>
                                </div>
                                <div class="col-md-4 label-cadastro">
                                    <label for="empresa_nome">Nome da Empresa *</label>
                                    <input value="<?=$dadosEmpresa['razao']?>" id="empresa-nome" class="form-control" type="text" name="empresa_nome" required autocomplete="off">
                                    <div class="invalid-feedback">
                                        Digite um nome válido.
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 label-cadastro">
                                    <label for="atividade-principal">Atividade Principal *</label>
                                    <input value="<?=$dadosEmpresa['cnae']['descricao']?>" id="atividade-principal" class="form-control" type="text" name="atividade_principal" required autocomplete="off">
                                    <div class="invalid-feedback">
                                        Obrigatório.
                                    </div>
                                </div>
                                <div class="col-md-2 label-cadastro">
                                    <label for="inicio-atividades">Início das Atividades</label>
                                    <input value="<?=$dadosEmpresa['inicioAtividade']?>" id="inicio-atividades" class="form-control" type="text" name="inicio_atividade" autocomplete="off" maxlength="2">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2 label-cadastro">
                                    <label for="tipo-societario">Tipo Societário *</label>
                                    <select name="tipo_societario" class="custom-select d-block w-100" id="tipo-societario" required>
                                        <option value="">Escolha...</option>
                                        <option value="Eireli">Eireli</option>
                                        <option value="LTDA">LTDA</option>
                                        <option value="Individual">Individual</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                                <div class="col-md-2 label-cadastro">
                                    <label for="regime-tributario">Regime Tributário *</label>
                                    <select name="regime_tributario" class="custom-select d-block w-100" id="regime-tributario" required>
                                        <option value="">Escolha...</option>
                                        <option value="SN">Simples Nacional</option>
                                        <option value="Presumido">Presumido</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                                <div class="col-md-2 label-cadastro">
                                    <label for="sn-data">Data Simples Nacional</label>
                                    <input value="<?=($dadosEmpresa['simplesNacional']['optante'] != 'Sim') ? null : $dadosEmpresa['simplesNacional']['inicio']?>" id="sn-data" class="form-control" type="text" name="sn_data" autocomplete="off">
                                </div>
                                <div class="col-md-2 label-cadastro">
                                    <label for="porte">Porte</label>
                                    <input value="<?=$dadosEmpresa['porte']['descricao']?>" id="porte" class="form-control" type="text" name="porte" autocomplete="off">
                                    <div class="invalid-feedback">
                                        Obrigatório.
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-5">
                                <div class="col-12 label-cadastro text-center">
                                    <h3>Sócio(s)</h3>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 mb-3 label-cadastro text-left">
                                    <label for="cpf">CPF</label>
                                    <input id="cpf" class="form-control" type="text">
                                    <div class="invalid-feedback">
                                        Digite um CPF válido.
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col text-center">
                                    <button type="button" class="btn btn-secondary btn-padrao font-weight-bold" onclick="carregaDadosCpf()">Adicionar Sócio</button>
                                </div>
                            </div>
                            <div id="socios" class="row"></div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-12 label-cadastro text-center">
                                    <h3>Endereço</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2 label-cadastro">
                                    <label for="iptu" class="label-cadastro">IPTU *</label>
                                    <input name="iptu" type="text" class="form-control" id="iptu" maxlength="30" required>
                                    <div class="invalid-feedback">
                                        Digite um número válido.
                                    </div>
                                </div>
                                <div class="col-md-2 label-cadastro">
                                    <label for="cep" class="label-cadastro">CEP *</label>
                                    <input value="<?=$dadosEmpresa['matrizEndereco']['cep']?>" name="cep" type="text" class="form-control" id="cep" maxlength="15" autocomplete="none" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 label-cadastro">
                                    <label for="logradouro" class="label-cadastro">Logradouro *</label>
                                    <input value="<?=$dadosEmpresa['matrizEndereco']['logradouro']?>" name="logradouro" type="text" class="form-control" id="logradouro" maxlength="50" autocomplete="none" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                                <div class="col-md-1 label-cadastro">
                                    <label for="numero-endereco" class="label-cadastro">Número *</label>
                                    <input value="<?=$dadosEmpresa['matrizEndereco']['numero']?>" name="numero_endereco" type="text" class="form-control" id="numero-endereco" maxlength="10" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3 label-cadastro" type="text" required>
                                    <label for="estado">Estado *</label>
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
                                <div class="col-md-2 label-cadastro">
                                    <label for="cidade" class="label-cadastro">Cidade *</label>
                                    <input value="<?=$dadosEmpresa['matrizEndereco']['cidade']?>" name="cidade" type="text" class="form-control" id="cidade" maxlength="50" autocomplete="none" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                                <div class="col-md-3 label-cadastro">
                                    <label for="bairro" class="label-cadastro">Bairro *</label>
                                    <input value="<?=$dadosEmpresa['matrizEndereco']['bairro']?>" name="bairro" type="text" class="form-control" id="bairro" maxlength="50" required>
                                    <div class="invalid-feedback">
                                        Obrigatório *
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5 label-cadastro">
                                    <label for="complemento" class="label-cadastro">Complemento<span class="text-muted">(Opicional)</span></label>
                                    <input value="<?=$dadosEmpresa['matrizEndereco']['complemento']?>" name="complemento" type="text" class="form-control" id="complemento" maxlength="50">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-2 label-cadastro">
                                    <label for="id-empresa">Número Empresa *</label>
                                    <input id="id-empresa" class="form-control" type="text" name="empresas_id" required autocomplete="off" maxlength="4">
                                    <div class="invalid-feedback">
                                        Obrigatório.
                                    </div>
                                </div>
                                <div class="col-md-2 label-cadastro">
                                    <label for="dia-honorarios">Dia&nbsp;vencimento&nbsp;honorários*</label>
                                    <input id="dia-honorarios" class="form-control" type="text" name="dia_honorarios" required autocomplete="off" maxlength="2">
                                    <div class="invalid-feedback">
                                        Obrigatório.
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 label-cadastro">
                                    <label for="plano">Plano *</label>
                                    <select name="planoid" class="custom-select d-block w-100 col-6" id="plano" required>
                                        <option value="">Escolha...</option>
                                        <?php foreach($planoArray as $plano) : ?>
                                            <option value="<?=$plano['id']?>"><?=$plano['nome']. ' - R$ ' .Helpers::formataMoedaView($plano['valor'])?></option>
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
                                <div class="col-md-2 label-cadastro">
                                    <label for="gestor">Gestor(a) *</label>
                                    <select name="gestor" class="custom-select d-block w-100" id="gestor" required>
                                        <option value="">Escolha...</option>
                                        <?php foreach($gestores as $gestor) : ?>
                                            <option value="<?=$gestor['id']?>"><?=$gestor['nome_gestor']?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Escolha um(a) Gestor(a).
                                    </div>
                                </div>
                                <div class="col-md-2 label-cadastro">
                                    <label for="contador">Contador(a) *</label>
                                    <select name="contador" class="custom-select d-block w-100" id="contador" required>
                                        <option value="">Escolha...</option>
                                        <?php foreach($contadores as $contador) : ?>
                                            <option value="<?=$contador['id']?>"><?=$contador['usuario']?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Escolha um(a) Contador(a).
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2 label-cadastro">
                                    <label for="pagamento-irpj-csll">Pagamento IRPJ/CSLL</label>
                                    <select name="pagamento_irpj_csll" class="custom-select d-block w-100" id="pagamento-irpj-csll">
                                        <option value="TRI">Trimestral</option>
                                        <option value="MEN">Mensal</option>
                                    </select>
                                </div>
                                <div class="col-md-2 label-cadastro">
                                    <label for="capital-social">Capital Social *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">R$</span>
                                        </div>
                                        <input id="capital-social" class="form-control" type="text" name="capital_social" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Digite um Capital Social válido.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6 label-cadastro">
                                    <label for="objeto">Objeto *</label>
                                    <textarea name="objeto" class="form-control col-9" rows="5" id="objeto" required autocomplete="off">CLÍNICA DE ATIVIDADES MÉDICAS.</textarea>
                                    <div class="invalid-feedback">
                                        Digite um Objeto válido.
                                    </div>
                                </div>
                                <div class="col-md-6 label-cadastro">
                                    <label for="vinculo">Vínculo *</label>
                                    <select name="vinculo" class="custom-select d-block w-100 col-6" id="vinculo" required>
                                        <option value="">Escolha...</option>
                                        <option value="MEDB">MEDB</option>
                                        <option value="MEDCONTABIL">MEDCONTABIL</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Escolha um vínculo.
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center mt-4 mb-5">
                                <button id="btn-continuar" type="submit" class="btn btn-padrao btn-success font-weight-bold">Cadastrar</button>
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

<script type="text/javascript">
    function carregaDadosCpf(){
        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "../api/cliente/consulta-cliente.php", true);
        xhttp.setRequestHeader("Content-type", "application/json");

        var cpfObjeto = {};

        cpfObjeto['cpf'] = cpf.value;

        var jsonParaEnviar = JSON.stringify(cpfObjeto);

        xhttp.send(jsonParaEnviar);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                populaDadosCpf(this.responseText);
            }
        };
    }

    var quantidadeSocios = 0;

    function populaDadosCpf(jsonDadosCpf) {
        quantidadeSocios++;

        var cpfObjeto = JSON.parse(jsonDadosCpf);

        var divSocios = document.getElementById('socios');

        var divRow = document.createElement('DIV');
        divRow.className = 'row';

        var divNome = document.createElement('DIV');
        divNome.className = 'col-md-6 mb-3 label-cadastro';
        divRow.appendChild(divNome);

        var label = document.createElement('LABEL');
        label.innerHTML = 'Nome *';
        divNome.appendChild(label);

        var inputId = document.createElement('INPUT');
        inputId.setAttribute('name', "socios["+quantidadeSocios+"][sociosId]");
        inputId.setAttribute('hidden', 'true');
        inputId.setAttribute('value', cpfObjeto['id']);
        inputId.className = 'form-control';
        divNome.appendChild(inputId);

        var inputNome = document.createElement('INPUT');
        inputNome.setAttribute('name', 'nome');
        inputNome.setAttribute('text', 'text');
        inputNome.setAttribute('autocomplete', 'none');
        inputNome.setAttribute('required', 'true');
        inputNome.setAttribute('readonly', 'true');
        inputNome.setAttribute('value', cpfObjeto['nome_completo']);
        inputNome.className = 'form-control';
        divNome.appendChild(inputNome);

        var divCpf = document.createElement('DIV');
        divCpf.className = 'col-md-6 mb-3 label-cadastro';
        divRow.appendChild(divCpf);

        var label = document.createElement('LABEL');
        label.innerHTML = 'CPF *';
        divCpf.appendChild(label);

        var inputCpf = document.createElement('INPUT');
        inputCpf.setAttribute('id', 'cpf2');
        inputCpf.setAttribute('name', 'cpf');
        inputCpf.setAttribute('text', 'text');
        inputCpf.setAttribute('autocomplete', 'none');
        inputCpf.setAttribute('required', 'true');
        inputCpf.setAttribute('readonly', 'true');
        inputCpf.setAttribute('value', cpfObjeto['cpf']);
        inputCpf.className = 'form-control';
        divCpf.appendChild(inputCpf);

        var divPorcentagem = document.createElement('DIV');
        divPorcentagem.className = 'col-md-2 mb-2 label-cadastro';
        divRow.appendChild(divPorcentagem);

        var label = document.createElement('LABEL');
        label.innerHTML = 'Porcentagem *';
        divPorcentagem.appendChild(label);

        var inputPorcentagem = document.createElement('INPUT');
        inputPorcentagem.setAttribute('name', "socios["+quantidadeSocios+"][porcentagem]");
        inputPorcentagem.setAttribute('text', 'text');
        inputPorcentagem.setAttribute('autocomplete', 'none');
        inputPorcentagem.setAttribute('required', 'true');
        inputPorcentagem.className = 'form-control';
        divPorcentagem.appendChild(inputPorcentagem);

        var divSocioAdministrador = document.createElement('DIV');
        divSocioAdministrador.className = 'col-md-4 mb-4 label-cadastro';
        divRow.appendChild(divSocioAdministrador);

        var label = document.createElement('LABEL');
        label.innerHTML = 'Sócio Administrador *';
        divSocioAdministrador.appendChild(label);

        var selectAdministrador = document.createElement('SELECT');
        selectAdministrador.className = 'custom-select d-block w-100 col-7';
        selectAdministrador.setAttribute('name', "socios["+quantidadeSocios+"][socio_administrador]");
        selectAdministrador.setAttribute('required', 'true');
        divSocioAdministrador.appendChild(selectAdministrador);

        var option = document.createElement('OPTION');
        option.setAttribute('value', '');
        option.innerHTML = 'Escolha...';
        selectAdministrador.appendChild(option);
        var option2 = document.createElement('OPTION');
        option2.setAttribute('value', 'Sim');
        option2.innerHTML = 'Sim';
        selectAdministrador.appendChild(option2);
        var option3 = document.createElement('OPTION');
        option3.setAttribute('value', 'Nao');
        option3.innerHTML = 'Não';
        selectAdministrador.appendChild(option3);

        divSocios.appendChild(divRow);

        $('#cpf').val('');
        $('#cpf').focus();
    }

</script>

<script type="text/javascript">
    <?php if ($dadosEmpresa['naturezaJuridica']['codigo'] != null) : ?>
        var tipoSocioetario = '<?=NaturezaJuridica::formataNaturezaJuridica($dadosEmpresa['naturezaJuridica']['codigo'])?>';
        var selectTipoSocietario = document.getElementById("tipo-societario");
        selectTipoSocietario.value = tipoSocioetario;
    <?php endif ?>

    <?php $regimeTributario = ($dadosEmpresa['simplesNacional'] == 'Não') ? 'Presumido' : 'SN';?>
        var regimeTributario = '<?=$regimeTributario?>';
        var selectRegimeTributario = document.getElementById("regime-tributario");
        selectRegimeTributario.value = regimeTributario;

    <?php if ($dadosEmpresa['matrizEndereco']['uf'] != null) : ?>
        var uf = '<?=$dadosEmpresa['matrizEndereco']['uf']?>';
        var selectUf = document.getElementById("estado");
        selectUf.value = uf;
    <?php endif ?>
</script>

<script type="text/javascript">
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
    select.setAttribute("name", "planoid_"+quantidadePlano);
    select.className = 'custom-select d-block w-100 col-6';
    var inputQuantidadePlano = document.createElement("INPUT");
    inputQuantidadePlano.setAttribute("name", "quantidade_plano");
    inputQuantidadePlano.setAttribute("value", quantidadePlano);
    inputQuantidadePlano.setAttribute("hidden", "true");
    divIncluirPlano.appendChild(inputQuantidadePlano);

    var option = document.createElement("OPTION");
    option.innerHTML = 'Escolha..';
    select.appendChild(option);

    <?php foreach($planoArray as $plano) : ?>
        var option = document.createElement("OPTION");
        option.setAttribute("value", "<?=$plano['id']?>");
        option.innerHTML = "<?=$plano['nome']. ' - R$ ' .Helpers::formataMoedaView($plano['valor'])?>";
        select.appendChild(option);
    <?php endforeach ?>

    divColuna.appendChild(select);
    divIncluirPlano.appendChild(divColuna);
}
</script>

<script type="text/javascript">
    $("#cpf").mask("000.000.000-00", {reverse: true});
    $("#cep").mask("00000-000");
    $("#cnpj").mask("00.000.000/0000-00", {reverse: true});
    $("#capital-social").mask('000.000.000,00', {reverse: true});
    $("#sn-data").mask('00/00/0000', {reverse: true});
</script>
