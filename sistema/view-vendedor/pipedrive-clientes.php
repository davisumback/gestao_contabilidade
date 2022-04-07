<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Lista de clientes cadastrados por mim ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');

use App\DAO\ClienteDAO;
use App\Helper\Helpers;
use App\Helper\Mensagem;

$dao = new ClienteDAO();
$clientes = $dao->getClientesAConfirmarPipedriveResumido($_SESSION['id_usuario']);
?>

<div class="container">
    <?=Mensagem::getMensagem($_COOKIE, 'confirmacaoCliente', 'mensagemConfirmacao');?>
    <?=Mensagem::getMensagem($_COOKIE, 'insercaoClienteOutroEscritorio', 'mensagemClienteOutroEscritorio');?>

    <div class="row">
        <div class="col-md-12">
            <?php if(empty($clientes)) : ?>
                <div class="alert alert-success mt-2 text-center" role="alert">
                    <h6 class="alert-heading">Você não possui confirmações à fazer ;)</h6>
                </div>
            <?php else : ?>
                <div class="text-center mb-3">
                    <div class="alert alert-success" role="alert">
                        <h6>Lista de clientes vindos do <strong>Pipedrive</strong> que precisam de confirmação no cadastro</h6>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="label-cadastro">
                            <tr>
                                <th scope="col">NOME</th>
                                <th scope="col">CPF</th>
                            </tr>
                        </thead>

                        <tbody class="texto-table">
                            <?php foreach ($clientes as $cliente) : ?>
                                <tr style="cursor:pointer" onclick="vaiPerfil('<?=$cliente['id']?>')">
                                    <td><?=$cliente['nome_completo']?></td>
                                    <td><?=Helpers::mask($cliente['cpf'], "###.###.###-##")?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>


<script type="text/javascript">
    function vaiPerfil(id){
        window.location = 'pipedrive-cliente.php?clienteId=' + id;
    }
</script>
