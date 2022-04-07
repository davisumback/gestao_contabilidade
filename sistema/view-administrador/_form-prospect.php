<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro de Prospects");
require_once('menu-left.php');
require_once('../cabecalho.php');

$usuariosId = $_SESSION['id_usuario'];
?>

<div class="container-fluid">

    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="label-cadastro">Área para cadastro dos Prospects</strong>
    </div>

    <?php if (array_key_exists('resultadoDadosProspect', $_COOKIE)) : ?>
        <?php $classResultado = ($_COOKIE['resultadoDadosProspect'] == 'true') ? 'alert-success' : 'alert-danger'; ?>

        <div class="alert <?=$classResultado?> alert-dismissible fade show text-center" role="alert">
            <strong><?= $_COOKIE['mensagemDadosProspect'] ?></strong>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <form class="needs-validation-loading" action="../controllers/prospect/insere-prospect.php" method="post" novalidate autocomplete="none">
        <input name="usuariosId" value="<?=$usuariosId?>" hidden>
        
        <div class="row mt-4">
            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label class="label-cadastro">Nome do Doutor</label>
                    <input class="form-control" type="text" name="nome_doutor" autocomplete="none">
                    <div class="invalid-feedback">
                        Obrigatório*
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label class="label-cadastro">Nome do Contato</label>
                    <input class="form-control" type="text" name="nome_contato" autocomplete="none">
                    <div class="invalid-feedback">
                        Obrigatório*
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label class="label-cadastro">Email</label>
                    <input class="form-control" type="text" name="email" autocomplete="none">
                    <div class="invalid-feedback">
                        Obrigatório*
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label class="label-cadastro">Telefone</label>
                    <input placeholder="(00) 0000-0000" class="form-control" type="text" id="telefone" name="telefone" autocomplete="none">
                    <div class="invalid-feedback">
                        Obrigatório*
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 align-items-center">
            <div class="col-7 col-md-5">
                <div class="form-group">
                    <label class="label-cadastro">Celular</label>
                    <input placeholder="(00) 90000-0000" class="form-control" type="text" id="celular" name="celular" autocomplete="none">
                </div>
            </div>

            <div class="col-3 col-md-4 label-cadastro">
                <div class="custom-control custom-checkbox mt-3">
                    <input id="whats" name="WhatsApp" class="custom-control-input" type="checkbox" autocomplete="none">
                    <label class="custom-control-label" for="whats">WhatsApp</label>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label class="label-cadastro">Nome da Empresa</label>
                    <input class="form-control" type="text" name="nome_empresa" autocomplete="none">
                </div>
            </div>

            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label class="label-cadastro">CNPJ</label>
                    <input placeholder="00.000.000/0000-00" class="form-control" type="text" id="cnpj" name="cnpj" autocomplete="none">
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-5 col-sm-12">
                <label class="label-cadastro">Estado *</label>
                <select class="form-control" name="estado" id="estado" required="" autocomplete="none">
                    <option value="">Escolha...</option>
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
                <div class="invalid-feedback">
                    Obrigatório*
                </div>
            </div>

            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label class="label-cadastro">Cidade *</label>
                    <input class="form-control" type="text" name="cidade" required="" autocomplete="none">
                    <div class="invalid-feedback">
                        Obrigatório*
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-5 col-sm-12">
                <label class="label-cadastro">Para qual empresa você está fazendo o Prospect *</label>
                <select class="form-control" name="empresa_vinculo" required="" autocomplete="none">
                    <option value="">Escolha...</option>
                    <option value="MEDB">Medb</option>
                    <option value="MEDCONTABIL">Medcontabil</option>
                    <option value="LAWB">Lawb</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório*
                </div>
            </div>

            <div class="col-md-5 col-sm-12">
                <label class="label-cadastro">Profissão *</label>
                <select class="form-control" name="profissao" required="" autocomplete="none">
                    <option value="">Escolha...</option>
                    <option value="MEDICO">Médico</option>
                    <option value="ADVOGADO">Advogado</option>
                    <option value="DENTISTA">Dentista</option>
                    <option value="FISIOTERAPEUTA">Fisioterapeuta</option>
                    <option value="PSICOLOGO">Psicólogo</option>
                    <option value="ESTETICISTA">Esteticista</option>
                    <option value="FONOAUDIOLOGO">Fonoaudiólogo</option>
                    <option value="FRANQUEADOS">Franqueados</option>
                </select>
                <div class="invalid-feedback">
                    Obrigatório*
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label class="label-cadastro">Especialidade</label>
                    <input class="form-control" type="text" name="especialidade" autocomplete="none">
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-5 div-botao-submit">
            <div class="col text-center">
                <button class="btn btn-padrao btn-success botao-submit" type="submit" name="button">Confirmar</button>
            </div>
        </div>
    </form>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#cnpj').mask('00.000.000/0000-00');
        $('#telefone').mask('(00) 0000-0000');
        $('#celular').mask('(00) 00000-0000');
    });
</script>
