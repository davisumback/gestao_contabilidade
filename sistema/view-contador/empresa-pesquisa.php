<?php

use App\Helper\Mensagem;
use App\DAO\EmpresaDAO;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Pesquisa de Empresas");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php
    $empresas = null;
    if(array_key_exists('empresas', $_COOKIE)){
        $empresas = json_decode($_COOKIE['empresas'], true);
    }

    if (array_key_exists('todasEmpresas', $_GET)) {
        $dao = new EmpresaDAO();
        $empresas = $dao->getNomeTodasEmpresas();
    }
?>

<div class="container-fluid">
    <div class="text-center mb-5">
        <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao_empresa', 'mensagem_insercao');?>
    </div>

    <div class="text-center mb-5">
        <?=Mensagem::getMensagem($_COOKIE, 'resultado_busca_empresa', 'mensagem_busca_empresa');?>
    </div>

    <div class="text-center mb-5">
        <?=Mensagem::getMensagem($_COOKIE, 'resultadoInfosEmpresa', 'mensagemInfosEmpresa');?>
    </div>

    <div id="div-pesquisa-invalida" class="row mb-5" hidden>
        <div class="col-12 text-center">
            <strong><span class="text text-danger" id="pesquisa-invalida"></span></strong>
        </div>
    </div>

    <form class="needs-validation-loading" id="form" action="../controllers/empresa/pesquisa-empresa.php" method="post" autocomplete="off" novalidate>
        <input name="pasta" value="<?=$_SESSION['pasta']?>" hidden>

        <div class="row text-center">
            <div class="col-md-4 mb-3 mx-auto label-cadastro">
                <label for="numero-empresa">Número da Empresa</label>
                <input id="numero-empresa" class="text-center form-control" type="text" name="numero_empresa" required autocomplete="none">
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-4 mx-auto mb-3 label-cadastro">
                <button type="submit" class="btn btn-padrao btn-info" >Pesquisar</button>
                <a class="btn btn-success btn-padrao" href="empresa-pesquisa.php?todasEmpresas=1">Pesquisar Todas</a>
            </div>
        </div>

    </form>

    <?php if($empresas != null) :?>
        <div class="row">
            <div class="table-responsive col-6 mx-auto">
                <table id="myTable" class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th class="label-cadastro" scope="col">Número</th>
                        <th class="label-cadastro" scope="col">Nome</th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach($empresas as $empresa) :?>
                        <tr style="cursor:pointer;" class="text-center" onclick="vaiParaPerfilEmpresa('<?=$empresa['id']?>')">
                            <td class="text-success"><?=$empresa['id']?></td>
                            <td class="text-success"><?=$empresa['nome_empresa']?></td>
                        </tr>
                     <?php endforeach ?>
                </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>

    <form id="form-perfil-empresa" action="../controllers/empresa/perfil-empresa.php" method="post" hidden>

    </form>
</div>

<?php
require_once('rodape.php');

require_once('../rodape.php');
?>

<script type="text/javascript">
    function vaiParaPerfilEmpresa(id){
        var formEmpresa = document.getElementById("form-perfil-empresa");

        var inputEmpresa = document.createElement("INPUT");
        inputEmpresa.setAttribute("hidden", "true");
        inputEmpresa.setAttribute("name", "empresas_id");
        inputEmpresa.setAttribute("value", id);
        formEmpresa.appendChild(inputEmpresa);
        formEmpresa.submit();
    }
</script>

<script type="text/javascript">
    window.onReady = document.getElementById('numero-empresa').focus();

    $(document).ready( function () {
        $('#myTable').DataTable( {
            language: {
                search:         "Pesquisar",
                lengthMenu:     "Mostrar _MENU_ Empresas",
                infoPostFix:    "",
                info:           "Mostrando _START_ de _END_ do total de _TOTAL_ empresas",
                loadingRecords: "Carregando...",
                zeroRecords:    "Nenhuma empresa encontrada",
                emptyTable:     "Nenhuma empresa cadastrada",
                paginate: {
                    first:      "Primeiro",
                    previous:   "Anterior",
                    next:       "Próximo",
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    } );
</script>

<script type="text/javascript">
    $("#numero-empresa").mask("0000");
</script>
