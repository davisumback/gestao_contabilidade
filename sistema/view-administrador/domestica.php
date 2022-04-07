<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro Doméstica");
require_once('menu-left.php');
require_once('../cabecalho.php');

$arquivoRetorno = 'domestica.php';
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'resultadoInsercaoDomestica', 'mensagemInsercaoDomestica');?>

    <div class="card">
        <div class="card-header bg-cor-accent-primaria">
            <i class="fas fa-user h5"></i><strong class="card-title pl-md-2 h5">Cadastro de uma nova doméstica</strong>
        </div>
        <div class="card-body">
            <form class="needs-validation-loading" action="../controllers/cliente/insere-domestica.php" method="post" autocomplete="off" novalidate>
                <input name="usuarios_id" value='<?=$_SESSION['id_usuario']?>' hidden>
                <input name="arquivoRetorno" value="<?=$arquivoRetorno?>" hidden>
                <input name="method" value="store" hidden>
                <div class="row justify-content-around mt-2 mb-3">
                    <div class="col text-center mb-3 label-cadastro">
                        <h3>Cadastro de Responsável Doméstica</h3>
                    </div>                    
                </div>
                <div class="row my-1">
                    <div class="col-md-2 mb-3 label-cadastro">
                        <label for="cpfResponsavel">CPF do Responsável *</label>
                        <input id="cpfResponsavel" class="form-control cpf" type="text" name="cpfResponsavel" required>
                        <div class="invalid-feedback">
                            Digite um CPF válido.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 label-cadastro">
                        <label for="nomeResponsavel">Nome do Responsável *</label>
                        <input id="nomeResponsavel" class="form-control" type="text" name="nomeResponsavel" required>
                        <div class="invalid-feedback">
                            Digite um CPF válido.
                        </div>
                    </div>                    
                </div>
                <div class="row my-1">
                    <div class="col-md-2">
                        <label for="cepResponsavel" class="label-cadastro">CEP do Responsável *</label>
                        <input name="cepResponsavel" type="text" class="form-control" id="cepResponsavel" maxlength="15" autocomplete="none" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="logradouroResponsavel" class="label-cadastro">Logradouro *</label>
                        <input name="logradouroResponsavel" type="text" class="form-control" id="logradouroResponsavel" maxlength="50" autocomplete="none" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="" class="label-cadastro">Número *</label>
                        <input name="numeroEnderecoResponsavel" type="text" class="form-control" id="numeroEnderecoResponsavel" maxlength="10" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-2">
                        <label for="bairroResponsavel" class="label-cadastro">Bairro *</label>
                        <input name="bairroResponsavel" type="text" class="form-control" id="bairroResponsavel" maxlength="50" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="cidadeResponsavel" class="label-cadastro">Cidade *</label>
                        <input name="cidadeResponsavel" type="text" class="form-control" id="cidadeResponsavel" maxlength="50" autocomplete="none" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-2 label-cadastro" type="text" required>
                        <label for="estadoResponsavel">Estado *</label>
                        <select name="ufEnderecoResponsavel" class="custom-select d-block w-100" id="estadoResponsavel" required>
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
                    <div class="col-md-7">
                        <label for="complementoResponsavel" class="label-cadastro">Complemento<span class="text-muted">(Opicional)</span></label>
                        <input name="complementoResponsavel" type="text" class="form-control" id="complementoResponsavel" maxlength="50">
                    </div>
                </div>
                <hr>
                <div class="row justify-content-around mt-3 mb-4">
                    <div class="col text-center mb-3 label-cadastro">
                        <h3>Cadastro da Doméstica</h3>
                    </div>                    
                </div>
                <div class="row mt-3">                    
                    <div class="col-md-2 label-cadastro">
                        <label for="cpf">CPF da Doméstica *</label>
                        <input id="cpf" class="form-control cpf" type="text" name="cpf" required>
                        <div class="invalid-feedback">
                            Digite um CPF válido.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 label-cadastro">
                        <label for="nome">Nome da Doméstica *</label>
                        <input name="nome" type="text" class="form-control" id="nome" autocomplete="none" required>
                        <div class="invalid-feedback">
                            Digite um nome válido.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="cep" class="label-cadastro">CEP da Doméstica *</label>
                        <input name="cep" type="text" class="form-control" id="cep" maxlength="15" autocomplete="none" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="logradouro" class="label-cadastro">Logradouro *</label>
                        <input name="logradouro" type="text" class="form-control" id="logradouro" maxlength="50" autocomplete="none" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="numero-endereco" class="label-cadastro">Número *</label>
                        <input name="numeroEndereco" type="text" class="form-control" id="numeroEndereco" maxlength="10" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="bairro" class="label-cadastro">Bairro *</label>
                        <input name="bairro" type="text" class="form-control" id="bairro" maxlength="50" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="cidade" class="label-cadastro">Cidade *</label>
                        <input name="cidade" type="text" class="form-control" id="cidade" maxlength="50" autocomplete="none" required>
                        <div class="invalid-feedback">
                            Obrigatório *
                        </div>
                    </div>
                    <div class="col-md-2 label-cadastro" type="text" required>
                        <label for="estado">Estado *</label>
                        <select name="ufEndereco" class="custom-select d-block w-100" id="estado" required>
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
                    <div class="col-md-7">
                        <label for="complemento" class="label-cadastro">Complemento<span class="text-muted">(Opicional)</span></label>
                        <input name="complemento" type="text" class="form-control" id="complemento" maxlength="50">
                    </div>
                </div>
                <div class="text-center my-3">
                    <button class="btn btn-success btn-padrao font-weight-bold" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>    
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">

    var cepResponsavel = document.getElementById("cepResponsavel");
    cepResponsavel.addEventListener("keyup", function(){
        if(cepResponsavel.value.length == 9){
            $("#cepResponsavel").blur();
            carregaEnderecoResponsavel();
        }
    });

    function carregaEnderecoResponsavel(){
        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "../../web-api/consulta-endereco.php", true);
        xhttp.setRequestHeader("Content-type", "application/json");

        var entrada = document.getElementById("cepResponsavel");
        var cepObjeto = {};

        cepObjeto['cep'] = entrada.value;

        var jsonParaEnviar = JSON.stringify(cepObjeto);

        xhttp.send(jsonParaEnviar);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                populaEnderecoResponsavel(this.responseText);
            }
        };
    }

    function populaEnderecoResponsavel(jsonEndereco){
        var enderecoObjeto = JSON.parse(jsonEndereco);
        
        var logradouro =  document.getElementById('logradouroResponsavel');
        logradouro.setAttribute("value", enderecoObjeto['logradouro']);

        var cidade =  document.getElementById('cidadeResponsavel');
        cidade.setAttribute("value", enderecoObjeto['localidade']);

        var bairro =  document.getElementById('bairroResponsavel');
        bairro.setAttribute("value", enderecoObjeto['bairro']);

        var complemento =  document.getElementById('complementoResponsavel');
        complemento.setAttribute("value", enderecoObjeto['complemento']);

        var estado =  document.getElementById(enderecoObjeto['uf']);
        estado.selected = "true";
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

    function dateToEN(date){
    	return date.split('/').reverse().join('-');
    }

    $(".cpf").mask("000.000.000-00", {reverse: true});
    $("#cep").mask("00000-000");

</script>
