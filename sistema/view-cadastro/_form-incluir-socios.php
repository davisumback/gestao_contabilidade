<?php
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');

$menu_topo->setTituloNavegacao("");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao_empresa', 'mensagem_insercao');?>

    <div class="text-center mb-3">
        <div class="alert alert-success" role="alert">
            <h6>Cadastro de empresa com clientes já existentes!</h6>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3 mx-auto mb-3 label-cadastro text-center">
            <label for="cpf">CPF *</label>
            <input id="cpf" class="form-control text-center" type="text">
            <div class="invalid-feedback">
                Digite um CPF válido.
            </div>
        </div>
    </div>

    <form class="needs-validation-loading" action="form-empresa-2.php" method="post" autocomplete="off" novalidate>
        <input name="usuarios_id" value='<?=$_SESSION['id_usuario']?>' hidden>

        <div id="socios">

        </div>

        <div class="text-right mb-5 mt-4">
            <button class="btn btn-cadastrar" type="submit">Prosseguir</button>
        </div>
    </form>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#cpf').focus();
    var cpf = document.getElementById("cpf");
    cpf.addEventListener("keyup", function(){
        if(cpf.value.length == 14){
            $("#cpf").blur();
            carregaDadosCpf();
        }
    });

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

    function populaDadosCpf(jsonDadosCpf) {
        var cpfObjeto = JSON.parse(jsonDadosCpf);

        var divSocios = document.getElementById('socios');

        var divNome = document.createElement('DIV');
        divNome.className = 'col-md-6 mb-3 label-cadastro';

        var label = document.createElement('LABEL');
        label.innerHTML = 'Nome *';
        divNome.appendChild(label);

        var inputId = document.createElement('INPUT');
        inputId.setAttribute('name', 'sociosId[]');
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

        divSocios.appendChild(divNome);
        divSocios.appendChild(divCpf);

        $('#cpf').val('');
        $('#cpf').focus();
    }

    $("#cpf").mask("000.000.000-00", {reverse: true});
    $("#cpf2").mask("000.000.000-00", {reverse: true});
</script>
