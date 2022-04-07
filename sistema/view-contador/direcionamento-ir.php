<?php
use App\DAO\ClienteDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Direcionamento Imposto de Renda :)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$dao = new ClienteDAO();
$clientes = $dao->getDirecionamentoIRAll();
?>

<div class="container pb-5 mb-5">
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            View do Direcionamento
        </div>
        <div class="card-body">
            <div class="row my-3">
                <div class="col text-center">
                    <a class="btn btn-success btn-padrao font-weight-bold" href="teste.php">Exportar</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive my-2">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead class="label-cadastro">
                                <tr class="table-success">
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col" class="text-nowrap">Trabalhou Pessoa Física</th>
                                    <th scope="col" class="text-nowrap">Recibo Pessoa Física</th>
                                    <th scope="col" class="text-nowrap">Obteve Recebimentos</th>
                                    <th scope="col" class="text-nowrap">Possui Imovel</th>
                                    <th scope="col" class="text-nowrap">Data Imovel</th>
                                    <th scope="col" class="text-nowrap">Valor Imovel</th>
                                    <th scope="col" class="text-nowrap">Soma Bens</th>
                                    <th scope="col" class="text-nowrap">Possui Veiculo</th>
                                    <th scope="col" class="text-nowrap">Data Veiculo</th>
                                    <th scope="col" class="text-nowrap">Valor Veiculo</th>
                                    <th scope="col" class="text-nowrap">Proprietário Consórcio</th>
                                    <th scope="col" class="text-nowrap">Renda Rural</th>
                                    <th scope="col" class="text-nowrap">Ganho Capital</th>
                                    <th scope="col">Herança</th>
                                    <th scope="col">Pensão</th>
                                    <th scope="col">Aluguel</th>
                                </tr>
                            </thead>
                            <tbody class="texto-table text-success">
                                <?php foreach ($clientes as $cliente) : ?>
                                <tr>
                                    <td>
                                        <?=$cliente['empresas_id']?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?=$cliente['nome_completo']?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?=Helpers::mask($cliente['cpf'], '###.###.###-##')?>
                                    </td>
                                    <td>
                                        <?=$cliente['trabalhou_pf']?>
                                    </td>
                                    <td>
                                        <?=$cliente['recibo_pf']?>
                                    </td>
                                    <td>
                                        <?=$cliente['obteve_recebimentos']?>
                                    </td>
                                    <td>
                                        <?=$cliente['possui_imovel']?>
                                    </td>
                                    <td>
                                        <?=Helpers::formataDataView($cliente['data_imovel'])?>
                                    </td>
                                    <td>
                                        <?=Helpers::formataMoedaView($cliente['valor_imovel'])?>
                                    </td>
                                    <td>
                                        <?=Helpers::formataMoedaView($cliente['soma_bens'])?>
                                    </td>
                                    <td>
                                        <?=$cliente['possui_veiculo']?>
                                    </td>
                                    <td>
                                        <?=Helpers::formataDataView($cliente['data_veiculo'])?>
                                    </td>
                                    <td>
                                        <?=Helpers::formataMoedaView($cliente['valor_veiculo'])?>
                                    </td>
                                    <td>
                                        <?=$cliente['proprietario_consorcio']?>
                                    </td>
                                    <td>
                                        <?=$cliente['renda_rural']?>
                                    </td>
                                    <td>
                                        <?=$cliente['ganho_capital']?>
                                    </td>
                                    <td>
                                        <?=$cliente['heranca']?>
                                    </td>
                                    <td>
                                        <?=$cliente['pensao']?>
                                    </td>
                                    <td>
                                        <?=$cliente['aluguel']?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>                
                </div>
            </div>
        </div>
    </div>    
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable({
            language: {
                search: "Pesquisar",
                lengthMenu: "Mostrar _MENU_ Clientes",
                infoPostFix: "",
                info: "Mostrando _START_ de _END_ do total de _TOTAL_ clientes",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum dado encontrado",
                emptyTable: "Nenhuma dado encontrado",
                paginate: {
                    first: "Primeiro",
                    previous: "Anterior",
                    next: "Próximo",
                    last: "Último"
                },
                aria: {
                    sortAscending: ": ativar para classificar a coluna em ordem crescente",
                    sortDescending: ": ativar para classificar a coluna em ordem decrescente"
                }
            }
        });
    });
</script>