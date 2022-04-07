<?php

use App\Helper\Helpers;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Buscar simulação");
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

if(array_key_exists('empresas_simulacoes', $_COOKIE)){
    $empresaSimulacaoes = json_decode($_COOKIE['empresas_simulacoes'], true);
}
?>

<?=Mensagem::getMensagem($_COOKIE, 'resposta_mensagem_simulacao', 'mensagem_simulacao');?>


<div class="text-center mt-2">
    <div class="alert alert-info" role="alert">
        <h6 class="alert-heading">O primeiro passo para consultar uma simulação, é pesquisar pelo número da empresa.</h6>
    </div>

    <form class="form-signin needs-validation-loading" action="../controllers/simulador/get-simulacao.php" method="post" novalidate autocomplete="off">
        <input name="empresa_numero" type="text" id="empresa-numero" class="form-control text-center col-3 mx-auto" required autofocus>
        <div class="invalid-feedback">
            Digite um número de empresa válido
        </div>
        <button class="btn btn-info btn-padrao font-weight-bold mt-4" type="submit">Buscar</button>
    </form>
</div>

<?php if (!empty($empresaSimulacaoes)) : ?>
    <div class="table-resposive">
        <table class="table table-striped table-bordered">
            <thead class="label-cadastro">
                <tr>
                    <th scope="col">Empresa</th>
                    <th scope="col">Id&nbspsimulação</th>
                    <th scope="col">Data</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody class="texto-table">
                <?php foreach($empresaSimulacaoes as $chaveArray => $valor) : ?>
                    <tr>
                        <td><?=$valor['empresa_numero']?></td>
                        <td><?=$valor['simulacao_id']?></td>
                        <td><?=Helpers::formataDataCompletaView($valor['hora_simulacao'])?></td>
                        <td class="text-right">
                            <form class="d-inline-block" action="simulador-resultado-com.php" method="post" style="margin-bottom:0;">
                                <?php
                                $_SESSION['id_simulacao'] = $valor['simulacao_id'];
                                ?>
                                <button class="btn btn-info btn-padrao">Visualizar</button>
                            </form>
                            <form class="d-inline-block" action="../controllers/simulador/deleta-simulacao.php" method="post" style="margin-bottom:0;">
                                <input name="simulacao_id" value="<?=$valor['simulacao_id']?>" hidden>
                                <input name="empresa_numero" value="<?=$valor['empresa_numero']?>" hidden>
                                <button class="btn btn-danger btn-padrao">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php endif ?>


<?php
require_once('rodape.php');
require_once('../rodape.php');
?>
