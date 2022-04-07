<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;
use App\Model\Os\OrdemDeServico;
use App\Model\Os\TipoOrdemDeServico;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Ordem de Serviço");
require_once('menu-left.php');
require_once('../cabecalho.php');

$method = $_REQUEST['method']; // Situação

$usuariosId = $_SESSION['id_usuario'];
$tipoOsId = $_GET['tipoOs'];

$ordemDeServico = new OrdemDeServico();
$ordensDeServicos = $ordemDeServico->$method($_REQUEST, $_SESSION['id_usuario']);

$tipoOs = new TipoOrdemDeServico();
$tiposOs = $tipoOs->getAll();
?>

<div class="container-fluid">
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="text-secondary">
            <?=(array_key_exists('view', $_REQUEST)) ? 'Todas Ordens de Serviços.' : $tipoOs->getTipoTitulo($_REQUEST['tipoOs']);?>
        </strong>
    </div>

    <?php Mensagem::getMensagem($_COOKIE, 'insercaoOs', 'mensagemInsercaoOs'); ?>

    <?php if (array_key_exists('view', $_REQUEST)) : ?>
        <form action="ordem-servico-lista.php" class="needs-validation-loading" method="get" novalidate>
            <input name="view" value="all" hidden>

            <div class="row">
                <div class="col-md-3 col-sm-12 mx-auto">
                    <div class="form-group text-center">
                        <label class="text-secondary" for="tipoOs"><strong>Tipo</strong></label>
                        <select class="form-control" name="tipoOs" id="tipoOs" required="true">
                            <option value="all">Todos</option>
                            <?php foreach ($tiposOs as $tipo) : ?>
                                <option value="<?=$tipo['id']?>" <?=($_REQUEST['tipoOs'] == $tipo['id']) ? 'selected' : ''?>> <?=$tipo['titulo']?> </option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            Obrigatório*
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 mx-auto">
                    <div class="form-group text-center">
                        <label class="text-secondary" for="tipoOs"><strong>Status</strong></label>
                        <select class="form-control" name="status" id="tipoOs" required>
                            <option value="all">Todos</option>
                            <option value="PENDENTE" <?=($_REQUEST['status'] == 'PENDENTE') ? 'selected' : ''?>>Pendentes</option>
                            <option value="FINALIZADA" <?=($_REQUEST['status'] == 'FINALIZADA') ? 'selected' : ''?>>Finalizadas</option>
                        </select>
                        <div class="invalid-feedback">
                            Obrigatório*
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 mx-auto">
                    <div class="form-group text-center">
                        <label class="text-secondary" for="tipoOs"><strong>Período</strong></label>
                        <select class="form-control" name="periodo" id="tipoOs" required>
                            <option value="30">Últimos 30 dias</option>
                            <option value="60" <?=($_REQUEST['periodo'] == 60) ? 'selected' : ''?>>Últimos 60 dias</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 mx-auto">
                    <div class="form-group text-center">
                        <label class="text-secondary" for="method"><strong>Situação</strong></label>
                        <select class="form-control" name="method" id="method" required>
                            <option value="getAllEmitidas">Emitidas</option>
                            <option value="getAllRecebidas" <?=($_REQUEST['method'] == 'getAllRecebidas') ? 'selected' : ''?>>Recebidas</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-12 mb-3">
                    <button class="btn btn-padrao btn-success">Pesquisar</button>
                </div>
            </div>
        </form>
    <?php else : ?>
        <div class="row">
            <div class="col-12 text-center">
                <?php if ($_GET['method'] == 'getAllEmitidas') : ?>
                    <button type="button" class="btn btn-padrao btn-success mb-3" data-toggle="modal" data-target="#osTipo<?=$_GET['tipoOs']?>">
                        Nova O.S
                    </button>
                <?php endif ?>                
                <form class="needs-validation-loading d-inline-block" action="ordem-servico-lista.php?method=getAllEmitidas&tipoOs=3">
                    <input name="tipoOs" value="<?=$_GET['tipoOs']?>" hidden>
                    <input name="method" value="<?=($_GET['method'] == 'getAllEmitidas') ? 'getAllRecebidas' : 'getAllEmitidas'?>" hidden>
                    <button type="submit" class="btn btn-padrao btn-success mb-3">
                        <?=($_GET['method'] == 'getAllEmitidas') ? 'O.S Recebidas' : 'O.S Emitidas'?>
                    </button>
                </form>
            </div>
        </div>
    <?php endif ?>

    <div class="row">
        <?php foreach ($ordensDeServicos as $os) : ?>
            <?php $cor = $ordemDeServico->decideCor($os['status']); ?>
            <div class="col-md-4 col-sm-12 text-center">
                <div class="card texto-padrao bg-light mb-3 border-<?=$cor?> rounded" style="cursor:pointer;" 
                    onClick="vaiParaNovaPagina('ordem-servico.php?situation=<?=$_REQUEST['method']?>&os=<?=$os['id']?>&method=<?=$os['metodo_get']?>')">
                    <div class="card-header bg-<?=$cor?> text-white">
                        <strong class="text-dark">O.S nº <?=$os['id']?> - <?=$os['status']?></strong>                        
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-right">
                            <span class="badge badge-secondary">
                                Criada <?=Helpers::formataDataView($os['created_at'])?>
                            </span>
                        </h6>
                        <h5 class="card-title">Empresa <?=$os['empresas_id']?></h5>
                        <h6 class="card-title"><?=$os['titulo']?></h6>
                        <h6 class="card-title"><?=$os['descricao']?></h6>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php
foreach ($tiposOs as $tipo) {
    if ($tipo['id'] == $_GET['tipoOs']) {
        include  __DIR__ . '/../modal/os/'.strtolower($tipo['tipo']).'/admin-novo-' . strtolower($tipo['tipo']) . '.php';
        break;
    }
}

require_once('rodape.php');
require_once('../rodape.php');
?>

<?php if ($_GET['tipoOs'] == 7) : ?>
    <script>
        var empresas = [];

        $.get("../api/empresa/empresasId.php", function(data, status) {
            var empresasArray = JSON.parse(data);

            for (let i = 0; i < empresasArray.length; i++) {
                empresas.push(empresasArray[i].id);
            }
        });

        autocomplete(document.getElementById("inputEmpresa"), empresas);

        function pesquisarSocios() {
            if ($('#inputEmpresa').val() == '') {
                $('#invalidFeedbackInputEmpresa').html("Obrigatório *");

                return;
            }

            $('#invalidFeedbackInputEmpresa').html("");
            $('#btnPesquisarSocios').attr("disabled", "true");
            $('#tableSocios').html("");

            var empresasId = $("#inputEmpresa").val();
            json = '{"empresasId": ' + empresasId + '}';

            $.post("../api/empresa/empresaSocios.php", json, function(result){
                var socios = JSON.parse(result);                
                $('#btnPesquisarSocios').removeAttr("disabled");

                if (socios.length == 0) {
                    $('#invalidFeedbackInputEmpresa').html("Sócio(s) não encontrado(s).");
                    return;
                }

                let x;

                var tabela = '<table id="myTable" class="mt-5 table table-bordered table-hover">' +
                                '<thead class="label-cadastro">' +
                                    '<tr class="table-success text-center" role="row">' +
                                        '<th scope="col">Nome</th>' +
                                        '<th scope="col">Sócio Administrador</th>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody class="label-cadastro text-success">';

                                
                for (x in socios) {
                    tabela += '<tr style="cursor:pointer;" onclick="submitForm('+socios[x].id+', '+empresasId+')">' +
                                '<td>' +socios[x].nome_completo+ '</td>' +
                                '<td>' +(socios[x].socio_administrador == 1 ? "Sim" : "Não")+ '</td>' +
                            '<tr>';
                }

                tabela += '</tbody></table>';

                $('#tableSocios').html(tabela);
            });
        }

        function submitForm(clientesId, empresasId) {
            $('#clientesId').val(clientesId);
            $('#empresasId').val(empresasId);
            $('#usuariosId').val(<?=$usuariosId?>);
            $('#formSociosEmpresa').submit();           
        }
    </script>
<?php endif ?>

<script>
    $('#proposta').change(function() {
        if ($('#proposta').val() == 'S') {
            abreViewProposta();
        } else {
            retiraViewProposta();
        }
    });

    function abreViewProposta() {
        var button = '<div class="text-center">' +
                        '<button type="button" onclick="adicionaItemProposta(\'asd\')" class="btn btn-sm btn-padrao btn-success">Adicionar item</button>' +
                    '</div>' +
                    '<div id="divItemProposta"></div>';

        $('#divPropostas').html(button);
    }

    function retiraViewProposta() {
        $('#divPropostas').html('');
    }

    var quantidade = 0;

    function adicionaItemProposta(htmlNovo) {
        quantidade += 1;
        
        htmlNovo = '<div class="row mt-3">' +
                        '<div class="col-md-4">' +
                            '<label class="label-cadastro">Valor</label>' +
                            '<div class="input-group mb-3">' +
                                '<div class="input-group-prepend">' +
                                    '<span class="input-group-text">R$</span>' +
                                '</div>' +
                                '<input onClick="adicionaMascara()" id="valor" name="itensProposta['+quantidade+'][valor]" type="text" class="form-control real" required>' +
                            '</div>' +
                        '</div>' +

                        '<div class="col-md-8">' +
                            '<label class="label-cadastro">Descrição Item</label>' +
                            '<textarea name="itensProposta['+quantidade+'][descricao]" class="form-control" name="" id="" cols="30" rows="5" required></textarea>' +
                        '</div>' +
                    '</div>';

        $('#divItemProposta').append(htmlNovo);
    }

    function adicionaMascara() {
        $('.real').mask('000.000,00', {reverse: true});       
    }
</script>