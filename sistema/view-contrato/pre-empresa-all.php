<?php
use App\Helper\Mensagem;
use App\DAO\PreEmpresaDAO;

// if (array_key_exists('numero_empresa', $_GET) && $_GET['numero_empresa'] != null) {
//     header('Location: ../controllers/empresa/perfil.php?empresas_id=' . $_GET['numero_empresa']);
//     die();
// }

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Processos de abertura ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php
    $empresaDAO = new PreEmpresaDAO();
    $empresas = $empresaDAO->getPreEmpresas();
?>

<div class="container-fluid">
    <?php if ($empresas != null) :?>
        <div class="alert alert-light text-center pt-4 pb-4" role="alert">
            <h6 class="label-cadastro">Pré-Empresas em processo de abertura</h6>
        </div>
    <?php else :?>
        <div class="alert alert-light text-center pt-4 pb-4" role="alert">
            <h6 class="label-cadastro">Você não possui processos de abertura de empresa</h6>
        </div>
    <?php endif ?>

    <?=Mensagem::getMensagem($_COOKIE, 'resultado_busca_empresa', 'mensagem_busca_empresa');?>
    <?=Mensagem::getMensagem($_COOKIE, 'resultadoInfosEmpresa', 'mensagemInfosEmpresa');?>

    <?php if($empresas != null) :?>
        <div class="row">
            <div class="table-responsive col-md-8 col-sm-12 mx-auto">
                <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr class="text-center">
                        <th class="label-cadastro" scope="col">Número</th>
                        <th class="label-cadastro" scope="col">Opção 1</th>
                        <th class="label-cadastro" scope="col">Opção 2</th>
                        <th class="label-cadastro" scope="col">Opção 3</th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach($empresas as $empresa) :?>
                        <tr style="cursor:pointer;" class="text-center" onclick="vaiParaPerfilEmpresa('<?=$empresa['id']?>')">
                            <td class="text-success"><?=$empresa['id']?></td>
                            <td class="text-success"><?=$empresa['nome_1']?></td>
                            <td class="text-success"><?=$empresa['nome_2']?></td>
                            <td class="text-success"><?=$empresa['nome_3']?></td>
                        </tr>
                     <?php endforeach ?>
                </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>

    <form id="form-perfil-empresa" action="../controllers/pre-empresa/perfil.php" method="post" hidden>

    </form>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    function vaiParaPerfilEmpresa(id){
        mostraGifLoading();
        var formEmpresa = document.getElementById("form-perfil-empresa");

        var inputEmpresa = document.createElement("INPUT");
        inputEmpresa.setAttribute("hidden", "true");
        inputEmpresa.setAttribute("name", "empresas_id");
        inputEmpresa.setAttribute("value", id);
        formEmpresa.appendChild(inputEmpresa);
        formEmpresa.submit();
    }
</script>
