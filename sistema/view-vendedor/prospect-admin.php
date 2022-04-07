<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro de Prospects");
require_once('menu-left.php');
require_once('../cabecalho.php');

$usuariosId = $_SESSION['id_usuario'];

if (array_key_exists('dataInicio', $_GET)) {
    $dataInicio = Helpers::formataDataBd($_GET['dataInicio']);
    $dataFim = Helpers::formataDataBd($_GET['dataFim']);
    $dao = new \App\DAO\ProspectDAO();
    $prospects = $dao->getProspectPorPeriodoFranqueado($dataInicio, $dataFim);
}

?>

<div class="container-fluid">
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="label-cadastro">Todos os Prospects :)</strong>
    </div>
    
    <form class="needs-validation-loading" action="prospect-admin.php" method="get">
        <div class="row mt-4 mb-4">
            <div class="col-md-2">
                <label class="label-cadastro" for="">Data Inicio</label>
                <input value="<?=(array_key_exists('dataInicio', $_GET)) ? $_GET['dataInicio'] : ''?>" name="dataInicio" class="form-control data-busca" type="text" required autocomplete="off">
            </div>
            <div class="col-md-2">
                <label class="label-cadastro" for="">Data Final</label>
                <input value="<?=(array_key_exists('dataFim', $_GET)) ? $_GET['dataFim'] : ''?>" name="dataFim" class="form-control data-busca" type="text" required autocomplete="off">
            </div>
            <div class="col-md-2 mt-2">
                <button class="btn btn-padrao btn-success font-weight-bold mt-4" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    <hr>

    <div class="container">
        <?=\App\Helper\Mensagem::getMensagem($_COOKIE, 'resultadoDadosProspect', 'mensagemDadosProspect')?>
    </div>

    <style>
        div.dataTables_wrapper  div.dataTables_filter {
            width: 100%;
            float: none;
            margin-left: 240px;
            text-align: left;
        }
    </style>

    <?php if (! empty($prospects)) : ?>
        <div class="table-responsive mb-5">
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">                   
                    <tr class="table-success">
                        <th scope="col">Usuário</th>
                        <th scope="col">Nome Doutor</th>
                        <th scope="col">Nome Contato</th>
                        <th scope="col">Nome Empresa</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Celular</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Profissão</th>
                        <th scope="col">Especialidade</th>
                        <th scope="col">Efetivado?</th>
                    </tr>
                </thead>

                <tbody class="label-cadastro">
                    <?php foreach ($prospects as $prospect) : ?>
                        <tr style="cursor:pointer;" >
                            <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['usuario']?></td>
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_doutor']?></td>
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_contato']?></td>
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_empresa']?></td>
                            <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['email']?></td>
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=($prospect['telefone'] != '') ? Helpers::mask($prospect['telefone'], '(##) ####-####') : ''?></td>
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=($prospect['celular'] != '') ? Helpers::mask($prospect['celular'], '(##) #####-####') : ''?></td>
                            <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['cnpj']?></td>
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['cidade']?></td>
                            <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['estado']?></td>
                            <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['profissao']?></td>
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['especialidade']?></td>
                            <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['efetivado']?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php elseif (array_key_exists('dataInicio', $_GET) && empty($prospects)) : ?>
        <div class="alert alert-danger font-weight-bold text-center mt-3" role="alert">
            Nenhum dado encontrado
        </div>
    <?php endif ?>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">    
    $(document).ready( function () {
        $('#myTable').DataTable( {
            language: {
                search:         "Pesquisar",
                lengthMenu:     "Mostrar _MENU_ Prospects",
                infoPostFix:    "",
                info:           "Mostrando _START_ de _END_ do total de _TOTAL_ prospects",
                loadingRecords: "Carregando...",
                zeroRecords:    "Nenhum dado encontrado",
                emptyTable:     "Nenhum dado encontrado",
                infoFiltered:   "(Filtrado do total de _MAX_ prospects)",
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

        $('#cnpj').mask('00.000.000/0000-00');
        $('#telefone').mask('(00) 0000-0000');
        $('#celular').mask('(00) 00000-0000');        
    } );
</script>

<script>
    $('.data-busca').mask('00/00/0000');
</script>