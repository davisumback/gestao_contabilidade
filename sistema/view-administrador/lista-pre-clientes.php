<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Lista de pré-clientes ;)");
require_once('menu-left.php');

require_once('../cabecalho.php');

use App\DAO\ClienteDAO;
use App\DAO\ClienteEmailDAO;

require_once('../../banco/conecta-medb.php');
require_once('../helper/helpers.php');

$pre_cliente_dao = new ClienteDAO($conexao);
$clientes_array = $pre_cliente_dao->getPreClientes();

?>

<div class="row">
    <div class="col-md-12">

        <?php if(empty($clientes_array)) { ?>
            <div class="alert alert-info mt-2 text-center" role="alert">
                <h6 class="alert-heading">Não temos pré-clientes cadastrados :(</h6>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="label-cadastro">
                        <tr>
                            <th scope="col">Usuário</th>
                            <th scope="col">NOME&nbspCOMPLETO</th>
                            <th scope="col">CPF</th>
                            <th scope="col">DATA&nbspDE&nbspCADASTRO</th>
                            <th scope="col">Status</th>
                        </tr>

                    </thead>

                    <tbody class="texto-table">
                        <?php foreach ($clientes_array as $cliente) : ?>
                            <tr>
                                <td><?=$cliente['usuario']?></td>
                                <td><?=$cliente['nome_completo']?></td>
                                <td><?=mask($cliente['cpf'], "###.###.###-##")?></td>
                                <td><?=formataDataView($cliente['data_cadastro'])?></td>
                                <td>
                                    <?php
                                        if ($cliente['aceitou'] == 1){
                                            echo 'Aceitou';
                                        }elseif($cliente['aceitou'] == null){
                                            echo 'Pendente';
                                        }
                                        else{
                                            echo 'Rejeitou';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

    </div>

</div>

<script type="text/javascript">
    function voltar (){
        location.assign("index.php");
    }
</script>


<?php
require_once('rodape.php');

require_once('../rodape.php');
?>
