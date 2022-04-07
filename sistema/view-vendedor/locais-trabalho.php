<?php
use App\Model\Cliente;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Nossos clientes :)');
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Cadastrar Local de Trabalho
        </div>
        <div class="card-body">
            <form class="needs-validation-loading" action="../controllers/grupob/locais-trabalho.php" method="post" enctype="multipart/form-data" autocomplete="none">
                <input name="method" value="store" hidden>
                <div class="row">
                    <div class="col-md-2">
                        <label class="label-cadastro" for="estado">Estado *</label>
                        <select name="ufEndereco" class="custom-select d-block w-100 font-weight-bold" id="estado1" required>
                            <!-- <option value="" id="escolha">Escolha...</option>
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
                            <option value="TO" id="TO">Tocantins</option> -->
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="label-cadastro" for="">Cidade</label>
                            <!-- <input type="text" class="form-control" id="cidade1" name="cidade" required> -->
                            <select name="cidade" class="custom-select d-block w-100 font-weight-bold" id="cidade1" required></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="label-cadastro" for="">Local</label>
                            <input type="text" class="form-control" id="" name="nome_local" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="label-cadastro" for="estado">Tipo de Serviço</label>
                        <select name="ufEndereco" class="custom-select d-block w-100 font-weight-bold" id="estado" required>
                            <option value="" id="escolha">Escolha...</option>
                            <option value="AC" id="AC">Plantão</option>
                            <option value="AL" id="AL">Clínico Geral</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="label-cadastro" for="">Contato</label>
                            <input type="text" class="form-control" id="" name="contato" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="label-cadastro" for="">Fone</label>
                            <input type="text" class="form-control" id="" name="fone" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="label-cadastro" for="">Enviar Edital</label>
                        <div class="custom-file">
                            <input id="input-upload" class="form-control" type="file" name="fileUpload" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="label-cadastro" for="">Data Validade</label>
                            <input type="date" class="form-control" id="" name="validade" required>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col text-center">
                        <button class="btn btn-padrao btn-success btn-padrao font-weight-bold" type="submit">Salvar</button>
                    </div>
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
    new dgCidadesEstados({
        cidade: document.getElementById('cidade1'),
        estado: document.getElementById('estado1')
    });
</script>